<?php
// on nome le namespace de notre entité User
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;



//ENtité User :  reprresente un user dans la base de donnée

// chaque propriété de la class est une colonne de la base de donnée

//l'entité impléments UserInterface pour la sécurité Symfony et PasswordAuthenticatedUserInterface pour la gestion des mots de passe

// UniqueEntity nous indique que le username doit etre unique

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{



    #[ORM\Id]
    #[ORM\GeneratedValue] //  auto-incrementé
    #[ORM\Column]  // cretation de column id
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $username = null;



// @see, @var indiquent un type attendu de variable 
// très utile poir les IDE (vscode ou phpstorm par exemple) : auto completion et surlignage d'erreur....
// pas obligatoire  mais recommandé : https://symfony.com/doc/current/best_practices.html#type-hints
    /**
     * @var list<string> The user roles
     */

     // liste des roles user exemple $roles = ['ROLE_USER', 'ROLE_ADMIN']
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 30)]
    private ?string $telephone = null; // le champ telephone ne peut pas etre  vide nullable=false par default

    #[ORM\Column(length: 255, nullable: true)] // le champ image peut etre vide 
    private ?string $image = null;

    /**
     * Get the value of id
     *
     * @return ?int
     */
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */

     // identifiant unique pour symfony  (utiliser pour l'authentification )
     // en general elle retourne un username ou un email
    public function getUserIdentifier(): string
    {
        return (string) $this->username; // (string) est un casting  si username n'est pas un string  il va le convertire en string
        // Par exemple, si $this->username est défini comme un entier (123), le casting (string) convertira cette valeur en une chaîne de caractères ("123").
        
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles); // array_unique permet de supprimer les doublons
     



    }



    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */

     // efface les données sensibles temporaires après l'authentification 
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        //  $this->password = null;


 
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
