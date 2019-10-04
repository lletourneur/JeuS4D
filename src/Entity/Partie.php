<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $pioche = [];

    /**
     * @ORM\Column(type="array")
     */
    private $main_j1 = [];

    /**
     * @ORM\Column(type="array")
     */
    private $main_j2 = [];

    /**
     * @ORM\Column(type="array")
     */
    private $plateau = [];

    /**
     * @ORM\Column(type="array")
     */
    private $terrain_j1 = [];

    /**
     * @ORM\Column(type="array")
     */
    private $terrain_j2 = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $tour;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $typeVictoire;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebutPartie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Joueur", inversedBy="partiesJ1")
     * @ORM\JoinColumn(nullable=false)
     */
    private $joueur1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Joueur", inversedBy="partieJ2")
     */
    private $joueur2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Joueur", inversedBy="gagnants")
     */
    private $gagnant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPioche(): ?array
    {
        return $this->pioche;
    }

    public function setPioche(array $pioche): self
    {
        $this->pioche = $pioche;

        return $this;
    }

    public function getMainJ1(): ?array
    {
        return $this->main_j1;
    }

    public function setMainJ1(array $main_j1): self
    {
        $this->main_j1 = $main_j1;

        return $this;
    }

    public function getMainJ2(): ?array
    {
        return $this->main_j2;
    }

    public function setMainJ2(array $main_j2): self
    {
        $this->main_j2 = $main_j2;

        return $this;
    }

    public function getPlateau(): ?array
    {
        return $this->plateau;
    }

    public function setPlateau(array $plateau): self
    {
        $this->plateau = $plateau;

        return $this;
    }

    public function getTerrainJ1(): ?array
    {
        return $this->terrain_j1;
    }

    public function setTerrainJ1(array $terrain_j1): self
    {
        $this->terrain_j1 = $terrain_j1;

        return $this;
    }

    public function getTerrainJ2(): ?array
    {
        return $this->terrain_j2;
    }

    public function setTerrainJ2(array $terrain_j2): self
    {
        $this->terrain_j2 = $terrain_j2;

        return $this;
    }

    public function getTour(): ?int
    {
        return $this->tour;
    }

    public function setTour(int $tour): self
    {
        $this->tour = $tour;

        return $this;
    }

    public function getTypeVictoire(): ?string
    {
        return $this->typeVictoire;
    }

    public function setTypeVictoire(string $typeVictoire): self
    {
        $this->typeVictoire = $typeVictoire;

        return $this;
    }

    public function getDateDebutPartie(): ?\DateTimeInterface
    {
        return $this->dateDebutPartie;
    }

    public function setDateDebutPartie(\DateTimeInterface $dateDebutPartie): self
    {
        $this->dateDebutPartie = $dateDebutPartie;

        return $this;
    }

    public function getJoueur1(): ?joueur
    {
        return $this->joueur1;
    }

    public function setJoueur1(?joueur $joueur1): self
    {
        $this->joueur1 = $joueur1;

        return $this;
    }

    public function getJoueur2(): ?joueur
    {
        return $this->joueur2;
    }

    public function setJoueur2(?joueur $joueur2): self
    {
        $this->joueur2 = $joueur2;

        return $this;
    }

    public function getGagnant(): ?joueur
    {
        return $this->gagnant;
    }

    public function setGagnant(?joueur $gagnant): self
    {
        $this->gagnant = $gagnant;

        return $this;
    }
}
