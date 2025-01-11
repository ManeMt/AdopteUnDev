<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeveloperRepository::class)]
class Developer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?float $minSalary = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $biography = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\OneToOne(inversedBy: 'developer', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, ProgramingLanguage>
     */
    #[ORM\ManyToMany(targetEntity: ProgramingLanguage::class, inversedBy: 'developers')]
    private Collection $programingLanguages;

    /**
     * @var Collection<int, Rating>
     */
    #[ORM\OneToMany(targetEntity: Rating::class, mappedBy: 'developer', orphanRemoval: true)]
    private Collection $yes;

    public function __construct()
    {
        $this->programingLanguages = new ArrayCollection();
        $this->yes = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getMinSalary(): ?float
    {
        return $this->minSalary;
    }

    public function setMinSalary(float $minSalary): static
    {
        $this->minSalary = $minSalary;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, ProgramingLanguage>
     */
    public function getProgramingLanguages(): Collection
    {
        return $this->programingLanguages;
    }

    public function addProgramingLanguage(ProgramingLanguage $programingLanguage): static
    {
        if (!$this->programingLanguages->contains($programingLanguage)) {
            $this->programingLanguages->add($programingLanguage);
        }

        return $this;
    }

    public function removeProgramingLanguage(ProgramingLanguage $programingLanguage): static
    {
        $this->programingLanguages->removeElement($programingLanguage);

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Rating $ye): static
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setDeveloper($this);
        }

        return $this;
    }

    public function removeYe(Rating $ye): static
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getDeveloper() === $this) {
                $ye->setDeveloper(null);
            }
        }

        return $this;
    }

}
