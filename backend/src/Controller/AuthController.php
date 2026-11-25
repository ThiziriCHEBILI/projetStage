<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\DBAL\Exception as DBALException;
use App\Form\RegistrationFormType;
use App\Entity\Users;

#[Route('/auth', name: 'app_auth')]
final class AuthController extends AbstractController
{
    #[Route('/register', name: '_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (!$data) {
                return $this->json(['message' => 'Données invalides ou corps de requête vide'], 400);
            }
            $user = new Users();
            $form = $this->createForm(RegistrationFormType::class, $user);
            $form->submit($data);

            if (!$form->isValid()) {
                return $this->json(["message" => (string) $form->getErrors(true)], 400);
            }

            $existingUser = $em->getRepository(Users::class)->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser) {
                return $this->json(['message' => 'Impossible de créer ce compte'], 400);
            }


            $user->setDateRegistration(new \DateTime());

            $plainPassword = $form->get('password')->getData();
            $hashedPassword = $hasher->hashPassword($user, $plainPassword);
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

    #[Route('/logout', name: 'logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
        $response = $this->json(['message' => 'Déconnexion réussie'], 200);
        $response->headers->clearCookie('BEARER', '/');

        return $response;
    }

    #[Route('/login', name: '_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        throw new \Exception('Cette méthode ne doit jamais être appelée.');
    }
}
