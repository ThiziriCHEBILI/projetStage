<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Exception as DBALException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use App\Entity\UserProgress;
use App\Entity\ShowVideo;

#[Route('/my-progress', name: 'app_my_progress')]
final class UserProgressController extends AbstractController
{
    private const FINISHED_PERCENT = 95;

    #[Route('', name: 'get_my_progress', methods: ['GET'])]
    public function getMyProgress(EntityManagerInterface $em): JsonResponse
    {
        try {
            $limit = new \DateTimeImmutable('-' . UserProgress::DAYS_BEFORE_REMOVE . ' days');

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

    #[Route('/{id}', name: 'put_my_progress', methods: ['PUT'], requirements: ['id' => '\d+'])]
    public function saveMyProgress(int $id, Request $request, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        try {
            $video = $em->getRepository(ShowVideo::class)->find($id);
            if (!$video) {
                return $this->json(['message' => 'Vidéo introuvable'], 404);
            }

            $data = json_decode($request->getContent(), true);
            if (!$data) {
                return $this->json(['message' => 'Données invalides ou corps de requête vide'], 400);
            }

            $constraints = new Assert\Collection([
                'watched_seconds' => [new Assert\NotNull(), new Assert\Type(type: 'integer'), new Assert\PositiveOrZero()],
            ]);

            $errors = $validator->validate($data, $constraints);
            if (count($errors) > 0) {
                return $this->json(['message' => (string) $errors], 400);
            }

            $watchedSeconds = min($data['watched_seconds'], $video->getDuration());
            $isFinished = $watchedSeconds >= $video->getDuration() * self::FINISHED_PERCENT / 100;

            $userProgress = $em->getRepository(UserProgress::class)->findOneBy([
                'user' => $this->getUser(),
                'show_video' => $video,
            ]);

            if ($isFinished) {
                if ($userProgress) {
                    $em->remove($userProgress);
                    $em->flush();
                }

                return $this->json(['message' => 'Vidéo terminée'], 200);
            }

            if (!$userProgress) {
                $userProgress = new UserProgress();
                $userProgress->setUser($this->getUser());
                $userProgress->setShowVideo($video);
            }

            $userProgress->setWatchedSeconds($watchedSeconds);
            $userProgress->setLastWatched(new \DateTimeImmutable());

            $em->persist($userProgress);
            $em->flush();

            return $this->json(['message' => 'Progression enregistrée'], 200);
        } catch (UniqueConstraintViolationException) {
            // Deux enregistrements en même temps : l'autre requête a déjà créé la ligne
            return $this->json(['message' => 'Progression enregistrée'], 200);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }

    #[Route('/{id}', name: 'delete_my_progress', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function deleteMyProgress(int $id, EntityManagerInterface $em): JsonResponse
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
            if (!$userProgress) {
                return $this->json(['message' => 'Progression introuvable'], 404);
            }

            $em->remove($userProgress);
            $em->flush();

            return $this->json(['message' => 'Progression retirée'], 200);
        } catch (DBALException) {
            return $this->json(['message' => 'Une erreur est survenue'], 500);
        } catch (\Exception) {
            return $this->json(['message' => 'Une erreur inattendue est survenue'], 500);
        }
    }
}
