<?php
// un namespace permet de classer logiquement les classes de la même application
namespace App\Entity;

// on importe la class repository associée à notre entité Produit
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
// assert
// NotBlank	Ne            pas laisser vide
// Positive	              Nombre > 0
// PositiveOrZero	      Nombre ≥ 0
// Length(min=5)	      Longueur minimum d'un texte
// Email	               Vérifier qu’une string est une adresse email valide
// Range(min=0, max=100)	Limite numérique (par ex. 0 ≤ âge ≤ 100)
// UniqueEntity (sur l'entité)	Unicité en base (par ex. un email unique)


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
  #[Assert\PositiveOrZero(message: "Le prix ne peut pas être négatif.")]
    private ?float $prix = null;

    /**
     * @var Collection<int, Panier>
     */
    #[ORM\OneToMany(targetEntity: Panier::class, mappedBy: 'produit')]
    private Collection $paniers;

    #[ORM\Column(nullable: true)]
    #[Assert\PositiveOrZero(message: "Le stock ne peut pas être négatif.")]
    private ?int $stock = null;

    public function __construct()
    {
        $this->paniers = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->setProduit($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        if ($this->paniers->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getProduit() === $this) {
                $panier->setProduit(null);
            }
        }

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
}
