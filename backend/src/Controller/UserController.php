<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\DBAL\Exception as DBALException;

#[Route('/user', name: 'app_user')]
final class UserController extends AbstractController
{
    #[Route('/me', name: '_me', methods: ['GET'])]
    public function getMe(Security $security): JsonResponse
    {
        try {
            $user = $security->getUser();
            if (!$user) {
                return $this->json(['message' => 'Non authentifié'], 401);
            }

            return $this->json($user, 200, [], ['groups' => 'user:read']);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }
}
