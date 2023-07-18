<?php

namespace App\Entity;

use App\Repository\SecretariatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecretariatRepository::class)]
class Secretariat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Document::class, inversedBy: 'secretariats')]
    private Collection $document;

    #[ORM\ManyToMany(targetEntity: MedicalCourse::class, inversedBy: 'secretariats')]
    private Collection $medicalCourse;

    #[ORM\ManyToMany(targetEntity: MedicalDiscipline::class, inversedBy: 'secretariats')]
    private Collection $medicalDiscipline;

    #[ORM\ManyToMany(targetEntity: SchemaContent::class, inversedBy: 'secretariats')]
    private Collection $schemaContent;

    #[ORM\ManyToMany(targetEntity: Video::class, inversedBy: 'secretariats')]
    private Collection $video;

    #[ORM\ManyToMany(targetEntity: Checklist::class, inversedBy: 'secretariats')]
    private Collection $checklist;

    #[ORM\OneToMany(mappedBy: 'secretariat', targetEntity: User::class)]
    private Collection $user;

    public function __construct()
    {
        $this->document = new ArrayCollection();
        $this->medicalCourse = new ArrayCollection();
        $this->medicalDiscipline = new ArrayCollection();
        $this->schemaContent = new ArrayCollection();
        $this->video = new ArrayCollection();
        $this->checklist = new ArrayCollection();
        $this->user = new ArrayCollection();
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

    /**
     * @return Collection<int, Document>
     */
    public function getDocument(): Collection
    {
        return $this->document;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->document->contains($document)) {
            $this->document->add($document);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        $this->document->removeElement($document);

        return $this;
    }

    /**
     * @return Collection<int, MedicalCourse>
     */
    public function getMedicalCourse(): Collection
    {
        return $this->medicalCourse;
    }

    public function addMedicalCourse(MedicalCourse $medicalCourse): self
    {
        if (!$this->medicalCourse->contains($medicalCourse)) {
            $this->medicalCourse->add($medicalCourse);
        }

        return $this;
    }

    public function removeMedicalCourse(MedicalCourse $medicalCourse): self
    {
        $this->medicalCourse->removeElement($medicalCourse);

        return $this;
    }

    /**
     * @return Collection<int, MedicalDiscipline>
     */
    public function getMedicalDiscipline(): Collection
    {
        return $this->medicalDiscipline;
    }

    public function addMedicalDiscipline(MedicalDiscipline $medicalDiscipline): self
    {
        if (!$this->medicalDiscipline->contains($medicalDiscipline)) {
            $this->medicalDiscipline->add($medicalDiscipline);
        }

        return $this;
    }

    public function removeMedicalDiscipline(MedicalDiscipline $medicalDiscipline): self
    {
        $this->medicalDiscipline->removeElement($medicalDiscipline);

        return $this;
    }

    /**
     * @return Collection<int, SchemaContent>
     */
    public function getSchemaContent(): Collection
    {
        return $this->schemaContent;
    }

    public function addSchemaContent(SchemaContent $schemaContent): self
    {
        if (!$this->schemaContent->contains($schemaContent)) {
            $this->schemaContent->add($schemaContent);
        }

        return $this;
    }

    public function removeSchemaContent(SchemaContent $schemaContent): self
    {
        $this->schemaContent->removeElement($schemaContent);

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->video->contains($video)) {
            $this->video->add($video);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        $this->video->removeElement($video);

        return $this;
    }

    /**
     * @return Collection<int, Checklist>
     */
    public function getChecklist(): Collection
    {
        return $this->checklist;
    }

    public function addChecklist(Checklist $checklist): self
    {
        if (!$this->checklist->contains($checklist)) {
            $this->checklist->add($checklist);
        }

        return $this;
    }

    public function removeChecklist(Checklist $checklist): self
    {
        $this->checklist->removeElement($checklist);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setSecretariat($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getSecretariat() === $this) {
                $user->setSecretariat(null);
            }
        }

        return $this;
    }
}
