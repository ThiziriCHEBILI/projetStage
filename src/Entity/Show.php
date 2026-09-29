<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name: '`show`')]
class Show
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['show:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Groups(['show:read'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['show:read'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['show:read'])]
    private ?\DateTime $date_publication = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['show:read'])]
    private ?\DateTime $release_date = null;

    #[ORM\ManyToOne(inversedBy: 'show')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['show:read'])]
    private ?CategoriesShow $categorie_show = null;
    /**
     * @var Collection<int, ShowVideo>
     */
    #[ORM\OneToMany(targetEntity: ShowVideo::class, mappedBy: 'show', cascade: ['remove'])]
    private Collection $showVideos;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['show:read'])]
    private ?string $award = null;


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
   
    public function getCategorieShow(): ?CategoriesShow
    {
        return $this->categorie_show;
    }

    public function setCategorieShow(?CategoriesShow $categorie_show): static
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

    public function getAward(): ?string
    {
        return $this->award;
    }

    public function setAward(?string $award): static
    {
        $this->award = $award;

        return $this;
    }
}
