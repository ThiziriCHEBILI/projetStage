<?php

namespace App\Entity;

use App\Repository\UserLecturesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserLecturesRepository::class)]
class UserLectures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $remaining_duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $last_watched = null;

    #[ORM\ManyToOne(inversedBy: 'userLectures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShowVideo $show_video = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRemainingDuration(): ?\DateTime
    {
        return $this->remaining_duration;
    }

    public function setRemainingDuration(\DateTime $remaining_duration): static
    {
        $this->remaining_duration = $remaining_duration;

        return $this;
    }

    public function getLastWatched(): ?\DateTime
    {
        return $this->last_watched;
    }

    public function setLastWatched(\DateTime $last_watched): static
    {
        $this->last_watched = $last_watched;

        return $this;
    }

    public function getUserId(): ?Users
    {
        return $this->user_id;
    }

    public function setUserId(?Users $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getShowVideoId(): ?ShowVideo
    {
        return $this->show_video;
    }

    public function setShowVideoId(?ShowVideo $show_video): static
    {
        $this->show_video = $show_video;

        return $this;
    }
}
