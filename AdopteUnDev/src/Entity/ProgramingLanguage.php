<?php

namespace App\Entity;

use App\Repository\ProgramingLanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgramingLanguageRepository::class)]
class ProgramingLanguage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entitled = null;

    /**
     * @var Collection<int, Developer>
     */
    #[ORM\ManyToMany(targetEntity: Developer::class, mappedBy: 'programingLanguages')]
    private Collection $developers;

    /**
     * @var Collection<int, JobAdd>
     */
    #[ORM\ManyToMany(targetEntity: JobAdd::class, mappedBy: 'programingLanguages')]
    private Collection $jobAdds;

    public function __construct()
    {
        $this->developers = new ArrayCollection();
        $this->jobAdds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntitled(): ?string
    {
        return $this->entitled;
    }

    public function setEntitled(string $entitled): static
    {
        $this->entitled = $entitled;

        return $this;
    }

    /**
     * @return Collection<int, Developer>
     */
    public function getDevelopers(): Collection
    {
        return $this->developers;
    }

    public function addDeveloper(Developer $developer): static
    {
        if (!$this->developers->contains($developer)) {
            $this->developers->add($developer);
            $developer->addProgramingLanguage($this);
        }

        return $this;
    }

    public function removeDeveloper(Developer $developer): static
    {
        if ($this->developers->removeElement($developer)) {
            $developer->removeProgramingLanguage($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, JobAdd>
     */
    public function getJobAdds(): Collection
    {
        return $this->jobAdds;
    }

    public function addJobAdd(JobAdd $jobAdd): static
    {
        if (!$this->jobAdds->contains($jobAdd)) {
            $this->jobAdds->add($jobAdd);
            $jobAdd->addProgramingLanguage($this);
        }

        return $this;
    }

    public function removeJobAdd(JobAdd $jobAdd): static
    {
        if ($this->jobAdds->removeElement($jobAdd)) {
            $jobAdd->removeProgramingLanguage($this);
        }

        return $this;
    }
    // Add this method
    public function __toString(): string
    {
        return $this->getEntitled();
    }
}
