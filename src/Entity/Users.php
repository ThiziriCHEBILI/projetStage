<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $surname = null;

    #[ORM\Column(length: 25)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_registration = null;

    /**
     * @var Collection<int, UserListShow>
     */
    #[ORM\OneToMany(targetEntity: UserListShow::class, mappedBy: 'user_id')]
    private Collection $userListShow;

    /**
     * @var Collection<int, UserLectures>
     */
    #[ORM\OneToMany(targetEntity: UserLectures::class, mappedBy: 'user_id')]
    private Collection $userLectures;

    public function __construct()
    {
        $this->userListShow = new ArrayCollection();
        $this->userLectures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getDateRegistration(): ?\DateTime
    {
        return $this->date_registration;
    }

    public function setDateRegistration(\DateTime $date_registration): static
    {
        $this->date_registration = $date_registration;

        return $this;
    }

    /**
     * @return Collection<int, UserListShow>
     */
    public function getUserListShow(): Collection
    {
        return $this->userListShow;
    }

    public function addUserListShow(UserListShow $userListShow): static
    {
        if (!$this->userListShow->contains($userListShow)) {
            $this->userListShow->add($userListShow);
            $userListShow->setUserId($this);
        }

        return $this;
    }

    public function removeUserListShow(UserListShow $userListShow): static
    {
        if ($this->userListShow->removeElement($userListShow)) {
            // set the owning side to null (unless already changed)
            if ($userListShow->getUserId() === $this) {
                $userListShow->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserLectures>
     */
    public function getUserLectures(): Collection
    {
        return $this->userLectures;
    }

    public function addUserLecture(UserLectures $userLecture): static
    {
        if (!$this->userLectures->contains($userLecture)) {
            $this->userLectures->add($userLecture);
            $userLecture->setUserId($this);
        }

        return $this;
    }

    public function removeUserLecture(UserLectures $userLecture): static
    {
        if ($this->userLectures->removeElement($userLecture)) {
            // set the owning side to null (unless already changed)
            if ($userLecture->getUserId() === $this) {
                $userLecture->setUserId(null);
            }
        }

        return $this;
    }
}
