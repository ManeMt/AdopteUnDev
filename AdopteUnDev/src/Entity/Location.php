<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entitled = null;

    public function __toString(): string
    {
        return $this->entitled ?? '';
    }

    /**
     * @var Collection<int, Company>
     */
    #[ORM\OneToMany(targetEntity: Company::class, mappedBy: 'location', orphanRemoval: true)]
    private Collection $companies;

    /**
     * @var Collection<int, JobAdd>
     */
    #[ORM\OneToMany(targetEntity: JobAdd::class, mappedBy: 'location', orphanRemoval: true)]
    private Collection $jobAdds;

    /**
     * @var Collection<int, Developer>
     */
    #[ORM\OneToMany(targetEntity: Developer::class, mappedBy: 'location', orphanRemoval: true)]
    private Collection $developers;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
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
     * @return Collection<int, Company>
     */
    public function getCompanies(): Collection
    {
        return $this->companies;
    }

    public function addCompany(Company $company): static
    {
        if (!$this->companies->contains($company)) {
            $this->companies->add($company);
            $company->setLocation($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): static
    {
        if ($this->companies->removeElement($company)) {
            // set the owning side to null (unless already changed)
            if ($company->getLocation() === $this) {
                $company->setLocation(null);
            }
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
            $jobAdd->setLocation($this);
        }

        return $this;
    }

    public function removeJobAdd(JobAdd $jobAdd): static
    {
        if ($this->jobAdds->removeElement($jobAdd)) {
            // set the owning side to null (unless already changed)
            if ($jobAdd->getLocation() === $this) {
                $jobAdd->setLocation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Developer>
     */
    public function getDeveloper(): Collection
    {
        return $this->developers;
    }

    public function addDeveloper(Developer $developer): static
    {
        if (!$this->developers->contains($developer)) {
            $this->developers->add($developer);
            $developer->setLocation($this);
        }

        return $this;
    }

    public function removeDeveloper(Developer $developer): static
    {
        if ($this->developers->removeElement($developer)) {
            // set the owning side to null (unless already changed)
            if ($developer->getLocation() === $this) {
                $developer->setLocation(null);
            }
        }

        return $this;
    }


}
