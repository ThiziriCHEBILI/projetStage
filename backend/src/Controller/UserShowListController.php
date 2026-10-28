<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use App\Entity\UserShowList;
use App\Entity\Show;

#[Route('/my-list', name: 'app_my_list')]
final class UserShowListController extends AbstractController
{

    #[Route('', name: 'get_my_list', methods: ['GET'])]
    public function getMyList(EntityManagerInterface $em): JsonResponse
    {
        try {
            $myList = $em->getRepository(UserShowList::class)->findBy(
                ['user' => $this->getUser()],
                ['date_added' => 'DESC']
            );

            $shows = [];
            foreach ($myList as $userShowList) {
                $shows[] = $userShowList->getShow();
            }

            return $this->json($shows, 200, [], ['groups' => ['show:read']]);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }


    #[Route('/{id}', name: 'post_my_list', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function addToMyList(int $id, EntityManagerInterface $em): JsonResponse
    {
        try {
            $show = $em->getRepository(Show::class)->find($id);
            if (!$show) {
                return $this->json(['message' => 'Show introuvable'], 404);
            }

            $alreadyAdded = $em->getRepository(UserShowList::class)->findOneBy([
                'user' => $this->getUser(),
                'show' => $show,
            ]);

            if ($alreadyAdded) {
                return $this->json(['message' => 'Ce show est déjà dans votre liste'], 409);
            }

            $userShowList = new UserShowList();
            $userShowList->setUser($this->getUser());
            $userShowList->setShow($show);
            $em->persist($userShowList);
            $em->flush();

            return $this->json(['message' => 'Show ajouté à votre liste'], 201);
        } catch (UniqueConstraintViolationException) {
            // Deux ajouts en même temps : l'autre requête a déjà ajouté le show
            return $this->json(['message' => 'Ce show est déjà dans votre liste'], 409);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }

    #[Route('/{id}', name: 'delete_my_list', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function removeFromMyList(int $id, EntityManagerInterface $em): JsonResponse
    {
        try {
            $userShowList = $em->getRepository(UserShowList::class)->findOneBy([
                'user' => $this->getUser(),
                'show' => $id,
            ]);
            if (!$userShowList) {
                return $this->json(['message' => "Ce show n'est pas dans votre liste"], 404);
            }

            $em->remove($userShowList);
            $em->flush();

            return $this->json(['message' => 'Show retiré de votre liste'], 200);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }
}
