<?php

namespace App\Entity;

use App\Repository\UserShowListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserShowListRepository::class)]
class UserShowList
{

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userShowList')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Show $show = null;


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
