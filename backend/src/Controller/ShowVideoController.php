<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ShowVideo;
use App\Entity\UserProgress;

#[Route('/videos', name: 'app_video')]
final class ShowVideoController extends AbstractController
{
    #[Route('/{id}/url', name: 'get_video_url', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function getVideoUrl(int $id, EntityManagerInterface $em): JsonResponse
    {
        try {
            $video = $em->getRepository(ShowVideo::class)->find($id);
            if (!$video) {
                return $this->json(['message' => 'Vidéo introuvable'], 404);
            }

            $userProgress = $em->getRepository(UserProgress::class)->findOneBy([
                'user' => $this->getUser(),
                'show_video' => $video,
            ]);

            $watchedSeconds = 0;
            if ($userProgress) {
                $watchedSeconds = $userProgress->getWatchedSeconds();
            }

            return $this->json([
                'url_video' => $video->getUrlVideo(),
                'watched_seconds' => $watchedSeconds,
            ], 200);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }
}
