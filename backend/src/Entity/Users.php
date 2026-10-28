<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    #[Groups(['user:read'])]
    private ?string $surname = null;

    #[ORM\Column(length: 25)]
    #[Groups(['user:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    #[Groups(['user:read'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    /**
     * @var list<string>
     */
    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['user:read'])]
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

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return list<string>
     */
    #[Groups(['user:read'])]
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

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
            $userShowList->setUser($this);
        }

        return $this;
    }

    public function removeUserShowList(UserShowList $userShowList): static
    {
        if ($this->userShowList->removeElement($userShowList)) {
            // set the owning side to null (unless already changed)
            if ($userShowList->getUser() === $this) {
                $userShowList->setUser(null);
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
            $userProgress->setUser($this);
        }

        return $this;
    }

    public function removeUserProgress(UserProgress $userProgress): static
    {
        if ($this->userProgress->removeElement($userProgress)) {
            // set the owning side to null (unless already changed)
            if ($userProgress->getUser() === $this) {
                $userProgress->setUser(null);
            }
        }

        return $this;
    }
}
