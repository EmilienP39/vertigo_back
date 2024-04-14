<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[Get]
#[Put(security: "is_granted('ROLE_ADMIN') or object.owner == user")]
#[GetCollection]
#[Post(security: "is_granted('ROLE_ADMIN')")]
#[Delete(security: "is_granted('ROLE_ADMIN')")]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $Contenu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DatePublication = null;

    #[ORM\Column(length: 255)]
    private ?string $Auteur = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'article')]
    private Collection $Images;

    /**
     * @var Collection<int, Source>
     */
    #[ORM\ManyToMany(targetEntity: Source::class, inversedBy: 'articles')]
    private Collection $Sources;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'articles')]
    private Collection $Categorie;

    public function __construct()
    {
        $this->Images = new ArrayCollection();
        $this->Sources = new ArrayCollection();
        $this->Categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): static
    {
        $this->Contenu = $Contenu;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->DatePublication;
    }

    public function setDatePublication(\DateTimeInterface $DatePublication): static
    {
        $this->DatePublication = $DatePublication;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->Auteur;
    }

    public function setAuteur(string $Auteur): static
    {
        $this->Auteur = $Auteur;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->Images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->Images->contains($image)) {
            $this->Images->add($image);
            $image->setArticle($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->Images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getArticle() === $this) {
                $image->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Source>
     */
    public function getSources(): Collection
    {
        return $this->Sources;
    }

    public function addSource(Source $source): static
    {
        if (!$this->Sources->contains($source)) {
            $this->Sources->add($source);
        }

        return $this;
    }

    public function removeSource(Source $source): static
    {
        $this->Sources->removeElement($source);

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->Categorie;
    }

    public function addCategorie(Categorie $categorie): static
    {
        if (!$this->Categorie->contains($categorie)) {
            $this->Categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): static
    {
        $this->Categorie->removeElement($categorie);

        return $this;
    }
}
