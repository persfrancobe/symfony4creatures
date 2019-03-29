<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagsRepository")
 */
class Tags
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Creatures", mappedBy="tags")
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
            $creature->addTag($this);
        }

        return $this;
    }

    public function removeCreature(Creatures $creature): self
    {
        if ($this->creatures->contains($creature)) {
            $this->creatures->removeElement($creature);
            $creature->removeTag($this);
        }

        return $this;
    }
}
