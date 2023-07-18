<?php

namespace App\Entity;

use App\Repository\ChecklistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChecklistRepository::class)]
class Checklist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'checklists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Secretariat::class, mappedBy: 'checklist')]
    private Collection $secretariats;

    #[ORM\OneToMany(mappedBy: 'checklist', targetEntity: UserChecklist::class)]
    private Collection $userChecklists;

    public function __construct()
    {
        $this->secretariats = new ArrayCollection();
        $this->userChecklists = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
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
            $secretariat->addChecklist($this);
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
     * @return Collection<int, UserChecklist>
     */
    public function getUserDocuments(): Collection
    {
        return $this->userChecklists;
    }

    public function addUserDocument(UserChecklist $userChecklist): self
    {
        if (!$this->userChecklists->contains($userChecklist)) {
            $this->userChecklists->add($userChecklist);
            $userChecklist->setChecklist($this);
        }

        return $this;
    }

    public function removeUserDocument(UserChecklist $userChecklist): self
    {
        if ($this->userChecklists->removeElement($userChecklist)) {
            // set the owning side to null (unless already changed)
            if ($userChecklist->getChecklist() === $this) {
                $userChecklist->setChecklist(null);
            }
        }

        return $this;
    }
}
