<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GenreRepository::class)
 */
class Genre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Editeur::class, mappedBy="genre")
     */
    private $Editeur;

    /**
     * @ORM\OneToMany(targetEntity=Livre::class, mappedBy="genre")
     */
    private $livres;

    public function __construct()
    {
        $this->Editeur = new ArrayCollection();
        $this->livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Editeur>
     */
    public function getEditeur(): Collection
    {
        return $this->Editeur;
    }

    public function addEditeur(Editeur $editeur): self
    {
        if (!$this->Editeur->contains($editeur)) {
            $this->Editeur[] = $editeur;
            $editeur->setGenre($this);
        }

        return $this;
    }

    public function removeEditeur(Editeur $editeur): self
    {
        if ($this->Editeur->removeElement($editeur)) {
            // set the owning side to null (unless already changed)
            if ($editeur->getGenre() === $this) {
                $editeur->setGenre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
            $livre->setGenre($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livres->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getGenre() === $this) {
                $livre->setGenre(null);
            }
        }

        return $this;
    }
}
