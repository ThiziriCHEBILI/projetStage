<?php

namespace App\Entity;

use App\Repository\UserListShowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserListShowRepository::class)]
class UserListShow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userListShow')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'userListShow')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Show $show_id = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getShowId(): ?Show
    {
        return $this->show_id;
    }

    public function setShowId(?Show $show_id): static
    {
        $this->show_id = $show_id;

        return $this;
    }
}
