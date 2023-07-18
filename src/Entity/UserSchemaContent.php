<?php

namespace App\Entity;

use App\Repository\UserSchemaContentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSchemaContentRepository::class)]
class UserSchemaContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isChecked = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $checkedAt = null;

    #[ORM\ManyToOne(inversedBy: 'userSchemaContents')]
    private ?SchemaContent $schemaContent = null;

    #[ORM\ManyToOne(inversedBy: 'userSchemaContents')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsChecked(): ?bool
    {
        return $this->isChecked;
    }

    public function setIsChecked(bool $isChecked): self
    {
        $this->isChecked = $isChecked;

        return $this;
    }

    public function getCheckedAt(): ?\DateTime
    {
        return $this->checkedAt;
    }

    public function setCheckedAt(?\DateTime $checkedAt): self
    {
        $this->checkedAt = $checkedAt;

        return $this;
    }

    public function getSchemaContent(): ?SchemaContent
    {
        return $this->schemaContent;
    }

    public function setSchemaContent(?SchemaContent $schemaContent): self
    {
        $this->schemaContent = $schemaContent;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
