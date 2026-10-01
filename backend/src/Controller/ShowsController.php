<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception as DBALException;
use App\Entity\Show;
use App\Entity\CategoriesShow;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/shows', name: 'app_show')]
final class ShowsController extends AbstractController
{
    #[Route('/a-la-une', name: 'get_shows_winners_by_category', methods: ['GET'])]
    public function getShowsWinners(EntityManagerInterface $em): JsonResponse
    {
        try {
            $categories = $em->getRepository(CategoriesShow::class)->findAll();

            $shows = [];
            foreach ($categories as $category) {
                $show = $em->getRepository(Show::class)->findOneBy(
                    ['award' => "award winner", 'categorie_show' => $category],
                    ['release_date' => 'DESC'],
                );
                if ($show) {
                    $shows[] = $show;
                }
            }

            return $this->json($shows, 200, [], ['groups' => 'show:read']);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }
    #[Route('/{name}', name: 'get_shows_by_category', methods: ['GET'])]
    public function getShowsByCategory(string $name, Request $request, EntityManagerInterface $em): JsonResponse
    {
        try {
            $category = $em->getRepository(CategoriesShow::class)->findOneBy(['name' => $name]);
            if (!$category) {
                return $this->json(['message' => 'Catégorie introuvable'], 404);
            }

            $page = (int) $request->query->get('page', 1);
            if ($page < 1) {
                $page = 1;
            }
            $limit = 12;
            $offset = ($page - 1) * $limit;

            $type = $request->query->get('type');
            $criteres = ['categorie_show' => $category];
            if ($type) {
                $criteres['type_show'] = $type;
            }

            $shows = $em->getRepository(Show::class)->findBy(
                $criteres,
                ['release_date' => 'DESC'],
                $limit,
                $offset
            );

            return $this->json($shows, 200, [], ['groups' => 'show:read']);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }

    #[Route('/{name}/{id}', name: 'get_one_show_by_category', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function getShowByCategory(string $name, int $id, EntityManagerInterface $em): JsonResponse
    {
        try {
            $category = $em->getRepository(CategoriesShow::class)->findOneBy(['name' => $name]);
            if (!$category) {
                return $this->json(['message' => 'Catégorie introuvable'], 404);
            }

            $show = $em->getRepository(Show::class)->findOneBy([
                'id' => $id,
                'categorie_show' => $category
            ]);
            if (!$show) {
                return $this->json(['message' => 'Show introuvable dans cette catégorie'], 404);
            }

            return $this->json($show, 200, [], ['groups' => 'show:read']);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }


    #[Route('/{name}', name: 'post_shows', methods: ['POST'])]
    public function createShow(string $name, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        try {

            $category = $em->getRepository(CategoriesShow::class)->findOneBy(["name" => $name]);
            if (!$category) {
                return $this->json(['message' => 'Catégorie introuvable'], 404);
            }

            $data = json_decode($request->getContent(), true);
            if (!$data) {
                return $this->json(["message" => "Données invalides ou corps de requête vide"], 400);
            }

            $constraints = new Assert\Collection([
                'title' => [new Assert\NotBlank(), new Assert\Type(type: 'string'), new Assert\Length(max: 30)],
                'description' => [new Assert\NotBlank(), new Assert\Type(type: 'string')],
                'release_date' => [new Assert\NotBlank(), new Assert\Date()],
                'type_show' => [new Assert\NotBlank(), new Assert\Choice(choices: ['sci-fi', 'drame', 'thriller', 'aventure', 'action', 'horreur'])],
            ]);

            $errors = $validator->validate($data, $constraints);
            if (count($errors) > 0) {
                return $this->json(["message" => (string) $errors], 400);
            }


            $show = new Show();
            $show->setTitle($data['title']);
            $show->setDescription($data['description']);
            $show->setDatePublication(new \DateTime());
            $show->setReleaseDate(new \DateTime($data['release_date']));
            $show->setTypeShow($data['type_show']);
            $show->setCategorieShow($category);
            $em->persist($show);
            $em->flush();

            return $this->json($show, 201, [], ['groups' => 'show:read']);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }

    #[Route('/{name}/{id}', name: 'put_one_show_by_category', methods: ['PUT'], requirements: ['id' => '\d+'])]
    public function updateShowByCategory(string $name, int $id, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse

    {
        try {

            $category = $em->getRepository(CategoriesShow::class)->findOneBy(['name' => $name]);
            if (!$category) {
                return $this->json(['message' => 'Catégorie introuvable'], 404);
            }

            $show = $em->getRepository(Show::class)->findOneBy([
                'id' => $id,
                'categorie_show' => $category
            ]);
            if (!$show) {
                return $this->json(['message' => 'Show introuvable dans cette catégorie'], 404);
            }
            $data = json_decode($request->getContent(), true);
            if (!$data) {
                return $this->json(["message" => "Données invalides ou corps de requête vide"], 400);
            }

            $constraints = new Assert\Collection([
                'title' => [new Assert\NotBlank(), new Assert\Type(type: 'string'), new Assert\Length(max: 30)],
                'description' => [new Assert\NotBlank(), new Assert\Type(type: 'string')],
                'release_date' => [new Assert\NotBlank(), new Assert\Date()],
                'type_show' => [new Assert\NotBlank(), new Assert\Choice(choices: ['sci-fi', 'drame', 'thriller', 'aventure', 'action', 'horreur'])],
            ]);

            $errors = $validator->validate($data, $constraints);
            if (count($errors) > 0) {
                return $this->json(["message" => (string) $errors], 400);
            }

            $show->setTitle($data['title']);
            $show->setDescription($data['description']);
            $show->setReleaseDate(new \DateTime($data['release_date']));
            $show->setTypeShow($data['type_show']);

            $em->flush();

            return $this->json($show, 200, [], ['groups' => 'show:read']);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }


    #[Route('/{name}/{id}', name: 'delete_one_show_by_category', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function deleteShowByCategory(string $name, int $id, EntityManagerInterface $em): JsonResponse

    {
        try {

            $category = $em->getRepository(CategoriesShow::class)->findOneBy(['name' => $name]);
            if (!$category) {
                return $this->json(['message' => 'Catégorie introuvable'], 404);
            }

            $show = $em->getRepository(Show::class)->findOneBy([
                'id' => $id,
                'categorie_show' => $category
            ]);
            if (!$show) {
                return $this->json(['message' => 'Show introuvable dans cette catégorie'], 404);
            }

            $em->remove($show);
            $em->flush();

            return $this->json(['message' => 'show supprimé avec succès'], 200);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }
}
