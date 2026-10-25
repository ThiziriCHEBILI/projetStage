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

    #[ORM\Column]
    private ?\DateTimeImmutable $date_added = null;

    public function __construct()
    {
        $this->date_added = new \DateTimeImmutable();
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

    public function getShow(): ?Show
    {
        return $this->show;
    }

    public function setShow(?Show $show): static
    {
        $this->show = $show;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeImmutable
    {
        return $this->date_added;
    }

    public function setDateAdded(\DateTimeImmutable $date_added): static
    {
        $this->date_added = $date_added;

        return $this;
    }
}
