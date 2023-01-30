<?php

namespace App\Entity;

use App\Repository\MedicalCourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalCourseRepository::class)]
class MedicalCourse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $step = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'medicalCourses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Secretariat::class, mappedBy: 'medicalCourse')]
    private Collection $secretariats;

    #[ORM\OneToMany(mappedBy: 'medicalCourse', targetEntity: UserMedicalCourse::class)]
    private Collection $userMedicalCourses;

    public function __construct()
    {
        $this->secretariats = new ArrayCollection();
        $this->userMedicalCourses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(int $step): self
    {
        $this->step = $step;

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

    public function addSecretariat(Secretariat $secretariat): self
    {
        if (!$this->secretariats->contains($secretariat)) {
            $this->secretariats->add($secretariat);
            $secretariat->addMedicalCourse($this);
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
     * @return Collection<int, UserMedicalCourse>
     */
    public function getUserMedicalCourses(): Collection
    {
        return $this->userMedicalCourses;
    }

    public function addUserMedicalCourses(UserMedicalCourse $userMedicalCourse): self
    {
        if (!$this->userMedicalCourses->contains($userMedicalCourse)) {
            $this->userMedicalCourses->add($userMedicalCourse);
            $userMedicalCourse->setMedicalCourse($this);
        }

        return $this;
    }

    public function removeUserMedicalCourse(UserMedicalCourse $userMedicalCourse): self
    {
        if ($this->userMedicalCourses->removeElement($userMedicalCourse)) {
            // set the owning side to null (unless already changed)
            if ($userMedicalCourse->getMedicalCourse() === $this) {
                $userMedicalCourse->setMedicalCourse(null);
            }
        }

        return $this;
    }
}
