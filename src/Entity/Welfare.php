<?php

namespace App\Entity;

use App\Repository\WelfareRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WelfareRepository::class)]
class Welfare
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $score = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $responseAt = null;

    #[ORM\ManyToOne(inversedBy: 'welfares')]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isCallBack = null;

    public function __construct()
    {
        $this->responseAt = new dateTimeImmutable();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getResponseAt(): ?\DateTimeImmutable
    {
        return $this->responseAt;
    }

    public function setResponseAt(?\DateTimeImmutable $responseAt): self
    {
        $this->responseAt = $responseAt;

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

    public function isIsCallBack(): ?bool
    {
        return $this->isCallBack;
    }

    public function setIsCallBack(?bool $isCallBack): self
    {
        $this->isCallBack = $isCallBack;

        return $this;
    }
}
