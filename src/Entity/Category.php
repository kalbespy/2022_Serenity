<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $progressbarColor = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $progressColor = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Checklist::class)]
    private Collection $checklists;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Document::class)]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: MedicalCourse::class)]
    private Collection $medicalCourses;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: MedicalDiscipline::class)]
    private Collection $medicalDisciplines;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: SchemaContent::class)]
    private Collection $schemaContents;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Video::class)]
    private Collection $videos;

    public function __construct()
    {
        $this->checklists = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->medicalCourses = new ArrayCollection();
        $this->medicalDisciplines = new ArrayCollection();
        $this->schemaContents = new ArrayCollection();
        $this->videos = new ArrayCollection();
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

    public function getProgressbarColor(): ?string
    {
        return $this->progressbarColor;
    }

    public function setProgressbarColor(?string $progressbarColor): self
    {
        $this->progressbarColor = $progressbarColor;

        return $this;
    }

    public function getProgressColor(): ?string
    {
        return $this->progressColor;
    }

    public function setProgressColor(?string $progressColor): self
    {
        $this->progressColor = $progressColor;

        return $this;
    }

    /**
     * @return Collection<int, Checklist>
     */
    public function getChecklists(): Collection
    {
        return $this->checklists;
    }

    public function addChecklist(Checklist $checklist): self
    {
        if (!$this->checklists->contains($checklist)) {
            $this->checklists->add($checklist);
            $checklist->setCategory($this);
        }

        return $this;
    }

    public function removeChecklist(Checklist $checklist): self
    {
        if ($this->checklists->removeElement($checklist)) {
            // set the owning side to null (unless already changed)
            if ($checklist->getCategory() === $this) {
                $checklist->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setCategory($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getCategory() === $this) {
                $document->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MedicalCourse>
     */
    public function getMedicalCourses(): Collection
    {
        return $this->medicalCourses;
    }

    public function addMedicalCourse(MedicalCourse $medicalCourse): self
    {
        if (!$this->medicalCourses->contains($medicalCourse)) {
            $this->medicalCourses->add($medicalCourse);
            $medicalCourse->setCategory($this);
        }

        return $this;
    }

    public function removeMedicalCourse(MedicalCourse $medicalCourse): self
    {
        if ($this->medicalCourses->removeElement($medicalCourse)) {
            // set the owning side to null (unless already changed)
            if ($medicalCourse->getCategory() === $this) {
                $medicalCourse->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MedicalDiscipline>
     */
    public function getMedicalDisciplines(): Collection
    {
        return $this->medicalDisciplines;
    }

    public function addMedicalDiscipline(MedicalDiscipline $medicalDiscipline): self
    {
        if (!$this->medicalDisciplines->contains($medicalDiscipline)) {
            $this->medicalDisciplines->add($medicalDiscipline);
            $medicalDiscipline->setCategory($this);
        }

        return $this;
    }

    public function removeMedicalDiscipline(MedicalDiscipline $medicalDiscipline): self
    {
        if ($this->medicalDisciplines->removeElement($medicalDiscipline)) {
            // set the owning side to null (unless already changed)
            if ($medicalDiscipline->getCategory() === $this) {
                $medicalDiscipline->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SchemaContent>
     */
    public function getSchemaContents(): Collection
    {
        return $this->schemaContents;
    }

    public function addSchemaContent(SchemaContent $schemaContent): self
    {
        if (!$this->schemaContents->contains($schemaContent)) {
            $this->schemaContents->add($schemaContent);
            $schemaContent->setCategory($this);
        }

        return $this;
    }

    public function removeSchemaContent(SchemaContent $schemaContent): self
    {
        if ($this->schemaContents->removeElement($schemaContent)) {
            // set the owning side to null (unless already changed)
            if ($schemaContent->getCategory() === $this) {
                $schemaContent->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setCategory($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getCategory() === $this) {
                $video->setCategory(null);
            }
        }

        return $this;
    }
}
