<?php

namespace App\Entity;

use App\Repository\SchemaContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchemaContentRepository::class)]
#[ORM\Table(name: '`schema_content`')]
class SchemaContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'schemaContents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: Secretariat::class, mappedBy: 'schemaContent')]
    private Collection $secretariats;

    #[ORM\OneToMany(mappedBy: 'schemaContent', targetEntity: UserSchemaContent::class)]
    private Collection $userSchemaContents;

    public function __construct()
    {
        $this->secretariats = new ArrayCollection();
        $this->userSchemaContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
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

    public function addSecretariat(Secretariat $secretariat): self
    {
        if (!$this->secretariats->contains($secretariat)) {
            $this->secretariats->add($secretariat);
            $secretariat->addSchemaContent($this);
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
     * @return Collection<int, UserSchemaContent>
     */
    public function getUserSchemaContents(): Collection
    {
        return $this->userSchemaContents;
    }

    public function addUserSchemaContent(UserSchemaContent $userSchemaContent): self
    {
        if (!$this->userSchemaContents->contains($userSchemaContent)) {
            $this->userSchemaContents->add($userSchemaContent);
            $userSchemaContent->setSchemaContent($this);
        }

        return $this;
    }

    public function removeUserSchemaContent(UserSchemaContent $userSchemaContent): self
    {
        if ($this->userSchemaContents->removeElement($userSchemaContent)) {
            // set the owning side to null (unless already changed)
            if ($userSchemaContent->getSchemaContent() === $this) {
                $userSchemaContent->setSchemaContent(null);
            }
        }

        return $this;
    }
}
