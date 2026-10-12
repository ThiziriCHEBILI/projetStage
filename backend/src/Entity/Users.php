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
     * @var Collection<int, UserShowList>
     */
    #[ORM\OneToMany(targetEntity: UserShowList::class, mappedBy: 'user')]
    private Collection $userShowList;

    /**
     * @var Collection<int, UserProgress>
     */
    #[ORM\OneToMany(targetEntity: UserProgress::class, mappedBy: 'user')]
    private Collection $userProgress;

    public function __construct()
    {
        $this->userShowList = new ArrayCollection();
        $this->userProgress = new ArrayCollection();
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
     * @return Collection<int, UserShowList>
     */
    public function getUserShowList(): Collection
    {
        return $this->userShowList;
    }

    public function addUserShowList(UserShowList $userShowList): static
    {
        if (!$this->userShowList->contains($userShowList)) {
            $this->userShowList->add($userShowList);
            $userShowList->setUserId($this);
        }

        return $this;
    }

    public function removeUserShowList(UserShowList $userShowList): static
    {
        if ($this->userShowList->removeElement($userShowList)) {
            // set the owning side to null (unless already changed)
            if ($userShowList->getUserId() === $this) {
                $userShowList->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserProgress>
     */
    public function getUserProgress(): Collection
    {
        return $this->userProgress;
    }

    public function addUserProgress(UserProgress $userProgress): static
    {
        if (!$this->userProgress->contains($userProgress)) {
            $this->userProgress->add($userProgress);
            $userProgress->setUserId($this);
        }

        return $this;
    }

    public function removeUserProgress(UserProgress $userProgress): static
    {
        if ($this->userProgress->removeElement($userProgress)) {
            // set the owning side to null (unless already changed)
            if ($userProgress->getUserId() === $this) {
                $userProgress->setUserId(null);
            }
        }

        return $this;
    }
}
