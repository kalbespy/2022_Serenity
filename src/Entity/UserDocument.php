<?php

namespace App\Entity;

use App\Repository\UserDocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserDocumentRepository::class)]
class UserDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isChecked = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $checkedAt = null;

    #[ORM\ManyToOne(inversedBy: 'userDocuments')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userDocuments')]
    private ?Document $document = null;

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

    public function getcheckedAt(): ?\DateTime
    {
        return $this->checkedAt;
    }

    public function setcheckedAt(?\DateTime $checkedAt): self
    {
        $this->checkedAt = $checkedAt;

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

    public function getDocument(): ?Document
    {
        return $this->document;
    }

    public function setDocument(?Document $document): self
    {
        $this->document = $document;

        return $this;
    }
}
