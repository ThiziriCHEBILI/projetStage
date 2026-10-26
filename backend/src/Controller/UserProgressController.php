<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception as DBALException;
use App\Entity\UserProgress;

#[Route('/my-progress', name: 'app_my_progress')]
final class UserProgressController extends AbstractController
{
    private const DAYS_BEFORE_REMOVE = 30;

    #[Route('', name: 'get_my_progress', methods: ['GET'])]
    public function getMyProgress(EntityManagerInterface $em): JsonResponse
    {
        try {
            $limit = new \DateTimeImmutable('-' . self::DAYS_BEFORE_REMOVE . ' days');

            $allProgress = $em->getRepository(UserProgress::class)->findBy(
                ['user' => $this->getUser()],
                ['last_watched' => 'DESC']
            );

            $progress = [];
            foreach ($allProgress as $userProgress) {
                if ($userProgress->getLastWatched() >= $limit) {
                    $progress[] = $userProgress;
                }
            }

            return $this->json($progress, 200, [], ['groups' => ['progress:read', 'show:read']]);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }
}
