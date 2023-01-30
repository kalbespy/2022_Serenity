<?php

namespace App\Entity;

use App\Repository\MedicalDisciplineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalDisciplineRepository::class)]
class MedicalDiscipline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'medicalDisciplines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Secretariat::class, mappedBy: 'medicalDiscipline')]
    private Collection $secretariats;

    #[ORM\OneToMany(mappedBy: 'medicalDiscipline', targetEntity: UserMedDiscipline::class)]
    private Collection $userMedDisciplines;

    public function __construct()
    {
        $this->secretariats = new ArrayCollection();
        $this->userMedDisciplines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $secretariat->addMedicalDiscipline($this);
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
     * @return Collection<int, UserMedDiscipline>
     */
    public function getUserMedicalDisciplines(): Collection
    {
        return $this->userMedDisciplines;
    }

    public function addUserMedicalDiscipline(UserMedDiscipline $userMedDiscipline): self
    {
        if (!$this->userMedDisciplines->contains($userMedDiscipline)) {
            $this->userMedDisciplines->add($userMedDiscipline);
            $userMedDiscipline->setMedicalDiscipline($this);
        }

        return $this;
    }

    public function removeUserMedicalDiscipline(UserMedDiscipline $userMedDiscipline): self
    {
        if ($this->userMedDisciplines->removeElement($userMedDiscipline)) {
            // set the owning side to null (unless already changed)
            if ($userMedDiscipline->getMedicalDiscipline() === $this) {
                $userMedDiscipline->setMedicalDiscipline(null);
            }
        }

        return $this;
    }
}
