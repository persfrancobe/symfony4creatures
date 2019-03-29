<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmsRepository")
 */
class Films
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $synopsis;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Creatures", mappedBy="film")
     */
    private $creatures;

    public function __construct()
    {
        $this->creatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Creatures[]
     */
    public function getCreatures(): Collection
    {
        return $this->creatures;
    }

    public function addCreature(Creatures $creature): self
    {
        if (!$this->creatures->contains($creature)) {
            $this->creatures[] = $creature;
            $creature->setFilm($this);
        }

        return $this;
    }

    public function removeCreature(Creatures $creature): self
    {
        if ($this->creatures->contains($creature)) {
            $this->creatures->removeElement($creature);
            // set the owning side to null (unless already changed)
            if ($creature->getFilm() === $this) {
                $creature->setFilm(null);
            }
        }

        return $this;
    }
}
