<?php

namespace App\Entity;

use App\Repository\ShowVideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ShowVideoRepository::class)]
class ShowVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['video:read', 'progress:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['video:read', 'progress:read'])]
    private ?string $description_video = null;

    #[ORM\Column(length: 255)]
    #[Groups(['video:read', 'progress:read'])]
    private ?string $image_video = null;

    #[ORM\Column(length: 255)]
    private ?string $url_video = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['video:read', 'progress:read'])]
    private ?int $episode_number = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['video:read', 'progress:read'])]
    private ?int $saison_number = null;

    #[ORM\Column(length: 10)]
    #[Groups(['video:read'])]
    private ?string $video_quality = null;

    #[ORM\Column]
    #[Groups(['video:read', 'progress:read'])]
    private ?int $duration = null;

    #[ORM\ManyToOne(inversedBy: 'showVideos')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    #[Groups(['progress:read'])]
    private ?Show $show = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionVideo(): ?string
    {
        return $this->description_video;
    }

    public function setDescriptionVideo(string $description_video): static
    {
        $this->description_video = $description_video;

        return $this;
    }

    public function getImageVideo(): ?string
    {
        return $this->image_video;
    }

    public function setImageVideo(string $image_video): static
    {
        $this->image_video = $image_video;

        return $this;
    }

    public function getUrlVideo(): ?string
    {
        return $this->url_video;
    }

    public function setUrlVideo(string $url_video): static
    {
        $this->url_video = $url_video;

        return $this;
    }

    public function getEpisodeNumber(): ?int
    {
        return $this->episode_number;
    }

    public function setEpisodeNumber(?int $episode_number): static
    {
        $this->episode_number = $episode_number;

        return $this;
    }

    public function getSaisonNumber(): ?int
    {
        return $this->saison_number;
    }

    public function setSaisonNumber(?int $saison_number): static
    {
        $this->saison_number = $saison_number;

        return $this;
    }

    public function getVideoQuality(): ?string
    {
        return $this->video_quality;
    }

    public function setVideoQuality(string $video_quality): static
    {
        $this->video_quality = $video_quality;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

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
}
