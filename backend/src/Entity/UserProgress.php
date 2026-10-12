<?php

namespace App\Entity;

use App\Repository\UserProgressRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserProgressRepository::class)]
class UserProgress
{

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $remaining_duration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $last_watched = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userProgress')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?ShowVideo $show_video = null;



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
        return $this->user;
    }

    public function setUserId(?Users $user): static
    {
        $this->user = $user;

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
