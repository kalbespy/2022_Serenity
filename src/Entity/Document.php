<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
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
    private ?int $readTime = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Secretariat::class, mappedBy: 'document')]
    private Collection $secretariats;

    #[ORM\OneToMany(mappedBy: 'document', targetEntity: UserDocument::class)]
    private Collection $userDocuments;

    public function __construct()
    {
        $this->secretariats = new ArrayCollection();
        $this->userDocuments = new ArrayCollection();
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

    public function getReadTime(): ?int
    {
        return $this->readTime;
    }

    public function setReadTime(int $readTime): self
    {
        $this->readTime = $readTime;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $secretariat->addDocument($this);
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
     * @return Collection<int, UserDocument>
     */
    public function getUserDocuments(): Collection
    {
        return $this->userDocuments;
    }

    public function addUserDocument(UserDocument $userDocument): self
    {
        if (!$this->userDocuments->contains($userDocument)) {
            $this->userDocuments->add($userDocument);
            $userDocument->setDocument($this);
        }

        return $this;
    }

    public function removeUserDocument(UserDocument $userDocument): self
    {
        if ($this->userDocuments->removeElement($userDocument)) {
            // set the owning side to null (unless already changed)
            if ($userDocument->getDocument() === $this) {
                $userDocument->setDocument(null);
            }
        }

        return $this;
    }
}
