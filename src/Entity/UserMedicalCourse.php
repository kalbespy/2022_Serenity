<?php

namespace App\Entity;

use App\Repository\UserMedicalCourseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserMedicalCourseRepository::class)]
class UserMedicalCourse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isChecked = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $checkedAt = null;

    #[ORM\ManyToOne(inversedBy: 'userMedicalCourses')]
    private ?MedicalCourse $medicalCourse = null;

    #[ORM\ManyToOne(inversedBy: 'userMedicalCourses')]
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

    public function setCheckedAt(\DateTime $checkedAt): self
    {
        $this->checkedAt = $checkedAt;

        return $this;
    }

    public function getMedicalCourse(): ?MedicalCourse
    {
        return $this->medicalCourse;
    }

    public function setMedicalCourse(?MedicalCourse $medicalCourse): self
    {
        $this->medicalCourse = $medicalCourse;

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
