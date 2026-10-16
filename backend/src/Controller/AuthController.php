<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/auth', name: 'app_auth')]
final class AuthController extends AbstractController
{
    #[Route('/register', name: '_register', methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $hasher, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['message' => 'Données manquantes ou invalides.'], 400);
        }
        return $this->json(['message' => 'ok']);
    }
}
