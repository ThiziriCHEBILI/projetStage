<?php

namespace App\Entity;

use App\Repository\UserProgressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserProgressRepository::class)]
class UserProgress
{

    #[ORM\Column]
    #[Groups(['progress:read'])]
    private ?int $position = null;

    #[ORM\Column]
    #[Groups(['progress:read'])]
    private ?\DateTimeImmutable $last_watched = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userProgress')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Users $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    #[Groups(['progress:read'])]
    private ?ShowVideo $show_video = null;


    public function __construct()
    {
        $this->last_watched = new \DateTimeImmutable();
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getLastWatched(): ?\DateTimeImmutable
    {
        return $this->last_watched;
    }

    public function setLastWatched(\DateTimeImmutable $last_watched): static
    {
        $this->last_watched = $last_watched;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getShowVideo(): ?ShowVideo
    {
        return $this->show_video;
    }

    public function setShowVideo(?ShowVideo $show_video): static
    {
        $this->show_video = $show_video;

        return $this;
    }
}
