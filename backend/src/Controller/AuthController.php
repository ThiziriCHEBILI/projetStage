<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\DBAL\Exception as DBALException;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Users;

#[Route('/auth', name: 'app_auth')]
final class AuthController extends AbstractController
{
    #[Route('/register', name: '_register', methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $hasher, EntityManagerInterface $em): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (!$data) {
                return $this->json(['message' => 'Données invalides ou corps de requête vide'], 400);
            }
            $constraints = new Assert\Collection([
                'name' => [new Assert\NotBlank(), new Assert\Type(type: 'string'), new Assert\Length(max: 25)],
                'surname' => [new Assert\NotBlank(), new Assert\Type(type: 'string'), new Assert\Length(max: 25)],
                'email' => [new Assert\NotBlank(), new Assert\Email(), new Assert\Length(max: 100)],
                'password' => [new Assert\NotBlank(), new Assert\Type(type: 'string'), new Assert\Length(min: 8)],
            ]);

            $errors = $validator->validate($data, $constraints);
            if (count($errors) > 0) {
                return $this->json(["message" => (string) $errors], 400);
            }

            $existingUser = $em->getRepository(Users::class)->findOneBy(['email' => $data['email']]);
            if ($existingUser) {
                return $this->json(['message' => 'Impossible de créer ce compte'], 400);
            }

            $user = new Users();
            $user->setName($data['name']);
            $user->setSurname($data['surname']);
            $user->setEmail($data['email']);
            $user->setDateRegistration(new \DateTime());

            $hashedPassword = $hasher->hashPassword($user, $data['password']);
            $user->setPassword($hashedPassword);

            $em->persist($user);
            $em->flush();

            return $this->json(['message' => 'compte créé avec succès'], 201);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }

    #[Route('/login', name: '_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        throw new \Exception('Cette méthode ne doit jamais être appelée.');
    }
}
