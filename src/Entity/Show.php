<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name: '`show`')]
class Show
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_publication = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $release_date = null;

    #[ORM\ManyToOne(inversedBy: 'show')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoriesShow $categorie_show = null;

    /**
     * @var Collection<int, ShowVideo>
     */
    #[ORM\OneToMany(targetEntity: ShowVideo::class, mappedBy: 'show')]
    private Collection $showVideos;

   
    public function __construct()
    {
        $this->showVideos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDatePublication(): ?\DateTime
    {
        return $this->date_publication;
    }

    public function setDatePublication(\DateTime $date_publication): static
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getReleaseDate(): ?\DateTime
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTime $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getCategorieShowId(): ?CategoriesShow
    {
        return $this->categorie_show;
    }

    public function setCategorieShowId(?CategoriesShow $categorie_show): static
    {
        $this->categorie_show = $categorie_show;

        return $this;
    }

    /**
     * @return Collection<int, ShowVideo>
     */
    public function getShowVideos(): Collection
    {
        return $this->showVideos;
    }

    public function addShowVideo(ShowVideo $showVideo): static
    {
        if (!$this->showVideos->contains($showVideo)) {
            $this->showVideos->add($showVideo);
            $showVideo->setShowId($this);
        }

        return $this;
    }

    public function removeShowVideo(ShowVideo $showVideo): static
    {
        if ($this->showVideos->removeElement($showVideo)) {
            // set the owning side to null (unless already changed)
            if ($showVideo->getShowId() === $this) {
                $showVideo->setShowId(null);
            }
        }

        return $this;
    }

   
}
