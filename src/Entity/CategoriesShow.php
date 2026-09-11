<?php

namespace App\Entity;

use App\Repository\CategoriesShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesShowRepository::class)]
class CategoriesShow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $name = null;

    /**
     * @var Collection<int, Show>
     */
    #[ORM\OneToMany(targetEntity: Show::class, mappedBy: 'categorie_show')]
    private Collection $show;

    public function __construct()
    {
        $this->show = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Show>
     */
    public function getShow(): Collection
    {
        return $this->show;
    }

    public function addShow(Show $show): static
    {
        if (!$this->show->contains($show)) {
            $this->show->add($show);
            $show->setCategorieShowId($this);
        }

        return $this;
    }

    public function removeShow(Show $show): static
    {
        if ($this->show->removeElement($show)) {
            // set the owning side to null (unless already changed)
            if ($show->getCategorieShowId() === $this) {
                $show->setCategorieShowId(null);
            }
        }

        return $this;
    }
}
