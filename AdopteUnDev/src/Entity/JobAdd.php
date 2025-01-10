<?php

namespace App\Entity;

use App\Repository\JobAddRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobAddRepository::class)]
class JobAdd
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $postTitle = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private int $numberView = 0;

    #[ORM\Column]
    private ?float $salary = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'jobAdds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    /**
     * @var Collection<int, ProgramingLanguage>
     */
    #[ORM\ManyToMany(targetEntity: ProgramingLanguage::class, inversedBy: 'jobAdds')]
    private Collection $programingLanguages;

    #[ORM\ManyToOne(inversedBy: 'jodAdds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    public function __construct()
    {
        $this->programingLanguages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostTitle(): ?string
    {
        return $this->postTitle;
    }

    public function setPostTitle(string $postTitle): static
    {
        $this->postTitle = $postTitle;

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

    public function getNumberView(): ?int
    {
        return $this->numberView;
    }

    public function setNumberViews(?int $numberView): static
    {
        $this->numberView = $numberView;

        return $this;
    }

    public function incrementNumberView(): void
    {
        $this->numberView++;
    }


    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

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

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }
}
