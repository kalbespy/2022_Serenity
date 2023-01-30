<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use DateTimeImmutable;
use Serializable;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface, Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isVerified = false;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[Vich\UploadableField(mapping: 'profile_picture', fileNameProperty: 'picture')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $profilePicture = null;

    #[ORM\Column]
    private ?string $phonenumber = null;

    #[ORM\ManyToOne(inversedBy: 'user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Secretariat $secretariat = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserDocument::class)]
    private Collection $userDocuments;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserChecklist::class)]
    private Collection $userChecklists;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserMedicalCourse::class)]
    private Collection $userMedicalCourses;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserSchemaContent::class)]
    private Collection $userSchemaContents;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserVideo::class)]
    private Collection $userVideos;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserMedDiscipline::class)]
    private Collection $userMedDisciplines;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isUploadedPicture = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Welfare::class)]
    private Collection $welfares;

    public function __construct()
    {
        $this->userDocuments = new ArrayCollection();
        $this->userChecklists = new ArrayCollection();
        $this->userMedicalCourses = new ArrayCollection();
        $this->userSchemaContents = new ArrayCollection();
        $this->userVideos = new ArrayCollection();
        $this->userMedDisciplines = new ArrayCollection();
        $this->welfares = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getSecretariat(): ?Secretariat
    {
        return $this->secretariat;
    }

    public function setSecretariat(?Secretariat $secretariat): self
    {
        $this->secretariat = $secretariat;

        return $this;
    }

    /**
     * @return Collection<int, UserDocument>
     */
    public function getUserDocuments(): Collection
    {
        return $this->userDocuments;
    }

    public function addUserDocument(UserDocument $userDocument): self
    {
        if (!$this->userDocuments->contains($userDocument)) {
            $this->userDocuments->add($userDocument);
            $userDocument->setUser($this);
        }

        return $this;
    }

    public function removeUserDocument(UserDocument $userDocument): self
    {
        if ($this->userDocuments->removeElement($userDocument)) {
            // set the owning side to null (unless already changed)
            if ($userDocument->getUser() === $this) {
                $userDocument->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserChecklist>
     */
    public function getUserChecklists(): Collection
    {
        return $this->userChecklists;
    }

    public function addUserChecklist(UserChecklist $userChecklist): self
    {
        if (!$this->userChecklists->contains($userChecklist)) {
            $this->userChecklists->add($userChecklist);
            $userChecklist->setUser($this);
        }

        return $this;
    }

    public function removeUserChecklist(UserChecklist $userChecklist): self
    {
        if ($this->userChecklists->removeElement($userChecklist)) {
            // set the owning side to null (unless already changed)
            if ($userChecklist->getUser() === $this) {
                $userChecklist->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserMedicalCourse>
     */
    public function getUserMedicalCourses(): Collection
    {
        return $this->userMedicalCourses;
    }

    public function addUserMedicalCourse(UserMedicalCourse $userMedicalCourse): self
    {
        if (!$this->userMedicalCourses->contains($userMedicalCourse)) {
            $this->userMedicalCourses->add($userMedicalCourse);
            $userMedicalCourse->setUser($this);
        }

        return $this;
    }

    public function removeUserMedicalCourse(UserMedicalCourse $userMedicalCourse): self
    {
        if ($this->userMedicalCourses->removeElement($userMedicalCourse)) {
            // set the owning side to null (unless already changed)
            if ($userMedicalCourse->getUser() === $this) {
                $userMedicalCourse->setUser(null);
            }
        }

        return $this;
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
            $userSchemaContent->setUser($this);
        }

        return $this;
    }

    public function removeUserSchemaContent(UserSchemaContent $userSchemaContent): self
    {
        if ($this->userSchemaContents->removeElement($userSchemaContent)) {
            // set the owning side to null (unless already changed)
            if ($userSchemaContent->getUser() === $this) {
                $userSchemaContent->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserVideo>
     */
    public function getUserVideos(): Collection
    {
        return $this->userVideos;
    }

    public function addUserVideo(UserVideo $userVideo): self
    {
        if (!$this->userVideos->contains($userVideo)) {
            $this->userVideos->add($userVideo);
            $userVideo->setUser($this);
        }

        return $this;
    }

    public function removeUserVideo(UserVideo $userVideo): self
    {
        if ($this->userVideos->removeElement($userVideo)) {
            // set the owning side to null (unless already changed)
            if ($userVideo->getUser() === $this) {
                $userVideo->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserMedDiscipline>
     */
    public function getUserMedDisciplines(): Collection
    {
        return $this->userMedDisciplines;
    }

    public function addUserMedDiscipline(UserMedDiscipline $userMedDiscipline): self
    {
        if (!$this->userMedDisciplines->contains($userMedDiscipline)) {
            $this->userMedDisciplines->add($userMedDiscipline);
            $userMedDiscipline->setUser($this);
        }

        return $this;
    }

    public function removeUserMedDiscipline(UserMedDiscipline $userMedDiscipline): self
    {
        if ($this->userMedDisciplines->removeElement($userMedDiscipline)) {
            // set the owning side to null (unless already changed)
            if ($userMedDiscipline->getUser() === $this) {
                $userMedDiscipline->setUser(null);
            }
        }

        return $this;
    }

    public function setProfilePicture(File $image = null): User
    {
        $this->profilePicture = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
            $this->isUploadedPicture = true;
        }
        return $this;
    }

    public function getProfilePicture(): ?File
    {
        return $this->profilePicture;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new DateTime();

        return $this;
    }

    public function isIsUploadedPicture(): ?bool
    {
        return $this->isUploadedPicture;
    }

    public function setIsUploadedPicture(?bool $isUploadedPicture): self
    {
        $this->isUploadedPicture = $isUploadedPicture;

        return $this;
    }

    public function serialize()
    {
        return serialize([
            'id' => $this->getId(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail(),
            'userLastname' => $this->getLastname(),
            'userFirstname' => $this->getFirstname(),
            'roles' => $this->getRoles(),
        ]);
    }

    public function unserialize($data)
    {
        $unserialized = unserialize($data);

        $this
            ->setId($unserialized['id'])
            ->setPassword($unserialized['password'])
            ->setEmail($unserialized['email'])
            ->setLastname($unserialized['userLastname'])
            ->setFirstname($unserialized['userFirstname'])
            ->setRoles($unserialized['roles']);
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Collection<int, Welfare>
     */
    public function getWelfares(): Collection
    {
        return $this->welfares;
    }

    public function addWelfare(Welfare $welfare): self
    {
        if (!$this->welfares->contains($welfare)) {
            $this->welfares->add($welfare);
            $welfare->setUser($this);
        }

        return $this;
    }

    public function removeWelfare(Welfare $welfare): self
    {
        if ($this->welfares->removeElement($welfare)) {
            // set the owning side to null (unless already changed)
            if ($welfare->getUser() === $this) {
                $welfare->setUser(null);
            }
        }

        return $this;
    }
}
