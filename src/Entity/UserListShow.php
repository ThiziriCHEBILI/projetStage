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
    private ?Users $user = null;

    #[ORM\ManyToOne(inversedBy: 'userListShow')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Show $show = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getShowId(): ?Show
    {
        return $this->show;
    }

    public function setShowId(?Show $show): static
    {
        $this->show = $show;

        return $this;
    }
}
