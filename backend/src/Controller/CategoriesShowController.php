<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Exception as DBALException;
use App\Entity\CategoriesShow;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/categories', name: 'app_categories_show')]
final class CategoriesShowController extends AbstractController
{
    #[Route('', name: 'get_categories_show', methods: ['GET'])]
    public function getCategoriesShow(EntityManagerInterface $em): JsonResponse
    {
        try {
            $categories = $em->getRepository(CategoriesShow::class)->findAll();
            if(!$categories){
                return $this->json(['message' => 'Aucune catégorie trouvée'], 404);
            }

            return $this->json($categories, 200, [], ['groups' => 'category:read']);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }

    #[Route('', name: 'post_category', methods: ['POST'])]
    public function createCategory(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (!$data) {
                return $this->json(["message" => "Données invalides ou corps de requête vide"], 400);
            }
            $constraints = new Assert\Collection([
                'name' => [new Assert\NotBlank(), new Assert\Type(type: 'string'), new Assert\Length(max: 25)],
             
            ]);

            $errors = $validator->validate($data, $constraints);
            if (count($errors) > 0) {
                return $this->json(["message" => (string) $errors], 400);
            }
            $category = $em->getRepository(CategoriesShow::class)->findOneBy(['name' => $data['name']]);
            if ($category) {
                return $this->json(['message' => 'Cette catégorie existe déjà'], 409);
            }
            $category = new CategoriesShow();
            $category->setName($data['name']);

            $em->persist($category);
            $em->flush();

            return $this->json($category, 201, [], ['groups' => 'category:read']);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }

#[Route('/{id}', name: 'delete_category', methods: ['DELETE'], requirements:['id' => '/id+'])]
    public function deleteCategory(int $id, EntityManagerInterface $em): JsonResponse

    {
        try {

            $category = $em->getRepository(CategoriesShow::class)->find($id);
            if (!$category) {
                return $this->json(['message' => 'Catégorie introuvable'], 404);
            }

            if (!$category->getShow()->isEmpty()) {
                return $this->json(['message' => 'cette categorie contient des shows'], 409);
            }

            $em->remove($category);
            $em->flush();

            return $this->json(['message' => 'categorie supprimée avec succès'], 200);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }


}
