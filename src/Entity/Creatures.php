<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CreaturesRepository")
 */
class Creatures
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
     * @ORM\Column(type="text")
     */
    private $texteLead;

    /**
     * @ORM\Column(type="text")
     */
    private $texteSuite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Films", inversedBy="creatures")
     */
    private $film;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags", inversedBy="creatures")
     */
    private $tags;

    /**
     * Creatures constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->dateCreation=new \DateTime();
        $this->slug = strtolower($this->nom);
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

    public function getTexteLead(): ?string
    {
        return $this->texteLead;
    }

    public function setTexteLead(string $texteLead): self
    {
        $this->texteLead = $texteLead;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTexteSuite()
    {
        return $this->texteSuite;
    }

    /**
     * @param mixed $texteSuite
     */
    public function setTexteSuite($texteSuite): void
    {
        $this->texteSuite = $texteSuite;
    }



    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getFilm(): ?Films
    {
        return $this->film;
    }

    public function setFilm(?Films $film): self
    {
        $this->film = $film;

        return $this;
    }

    /**
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }
}
