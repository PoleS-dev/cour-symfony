<?php
// un namespace permet de classer logiquement les classes de la même application
namespace App\Entity;

// on importe la class repository associée à notre entité Produit
use App\Repository\ProduitRepository;

// on importe les annotations Doctrine
use Doctrine\ORM\Mapping as ORM;


// on  indique que cette class est une entité Doctrine et qu'elle est liee au repository ProduitRepository
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]  // clé primaire de l'entité
    #[ORM\GeneratedValue] // auto-increment
    #[ORM\Column]// la colonne de l'entité
    private ?int $id = null; // propriété privé de la class avec typage int et valeur par defaut null 

    #[ORM\Column(length: 255)] // colonne name de type string de longueur 255
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'user')]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    #[ORM\Column]
    private ?float $prix = null;

    // getter et setter

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }
}
