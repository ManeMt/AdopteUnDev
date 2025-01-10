<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeveloperRepository::class)]
class Developer extends User
{
    #[ORM\Column(length: 40, nullable: true)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastName = null;

    #[ORM\Column(nullable: true)]
    private ?float $minSalary = null;

    #[ORM\Column(nullable: true)]
    private ?int $level = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $biography = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getMinSalary(): ?float
    {
        return $this->minSalary;
    }

    public function setMinSalary(?float $minSalary): static
    {
        $this->minSalary = $minSalary;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): static
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
