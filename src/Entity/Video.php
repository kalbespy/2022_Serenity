<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Secretariat::class, mappedBy: 'video')]
    private Collection $secretariats;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: UserVideo::class)]
    private Collection $userVideos;

    public function __construct()
    {
        $this->secretariats = new ArrayCollection();
        $this->userVideos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function addSecretariat(Secretariat $secretariat): self
    {
        if (!$this->secretariats->contains($secretariat)) {
            $this->secretariats->add($secretariat);
            $secretariat->addVideo($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Secretariat>
     */
    public function getSecretariats(): Collection
    {
        return $this->secretariats;
    }

    /**
     * @return Collection<int, UserVideo>
     */
    public function getUserVideos(): Collection
    {
        return $this->userVideos;
    }

    public function addUserVideo(UserVideo $userVideo): self
    {
        if (!$this->userVideos->contains($userVideo)) {
            $this->userVideos->add($userVideo);
            $userVideo->setVideo($this);
        }

        return $this;
    }

    public function removeUserVideo(UserVideo $userVideo): self
    {
        if ($this->userVideos->removeElement($userVideo)) {
            // set the owning side to null (unless already changed)
            if ($userVideo->getVideo() === $this) {
                $userVideo->setVideo(null);
            }
        }

        return $this;
    }
}
