<?php
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['developer' => Developer::class, 'company' => Company::class])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $roles; //= []

    // #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    // private ?Developer $developer = null;

    #[ORM\Column(type: 'boolean', options: ["default" => false])]
    private ?bool $completeProfile = false;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';  // Le rôle par défaut

        return array_unique($roles);
    }

    public function setRoles(String $roles): static
    {
        $this->roles = [$roles];

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    // public function getDeveloper(): ?Developer
    // {
    //     return $this->developer;
    // }

    public function isCompleteProfile(): ?bool
    {
        return $this->completeProfile;
    }

    public function setCompleteProfile(bool $completeProfile): static
    {
        $this->completeProfile = $completeProfile;

        return $this;
    }
    


    public function eraseCredentials(): void
    {
        // Si vous stockez des informations sensibles supplémentaires, vous pouvez les effacer ici.
        // Par exemple, effacer un mot de passe temporaire ou des données sensibles.
        // Dans ce cas, vous n'avez rien à effacer, donc la méthode peut être vide.
    }

    // Si vous utilisez bcrypt ou argon2, vous n'avez pas besoin de la méthode getSalt().
    public function getSalt(): ?string
    {
        // Cette méthode peut être vide si vous utilisez des algorithmes modernes (comme bcrypt ou argon2)
        return null;
    }

    
}

