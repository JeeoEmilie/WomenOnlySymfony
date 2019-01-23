<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $startplace;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placearrived;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TransportType", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $transportType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $placeNumber;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedAt(): ?\DateTimeInterface
    {
        return $this->datedAt;
    }

    public function setDatedAt(\DateTimeInterface $datedAt): self
    {
        $this->datedAt = $datedAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getStartplace(): ?string
    {
        return $this->startplace;
    }

    public function setStartplace(string $startplace): self
    {
        $this->startplace = $startplace;

        return $this;
    }

    public function getPlacearrived(): ?string
    {
        return $this->placearrived;
    }

    public function setPlacearrived(string $placearrived): self
    {
        $this->placearrived = $placearrived;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTransportType(): ?TransportType
    {
        return $this->transportType;
    }

    public function setTransportType(?TransportType $transportType): self
    {
        $this->transportType = $transportType;

        return $this;
    }

    public function getPlaceNumber(): ?int
    {
        return $this->placeNumber;
    }

    public function setPlaceNumber(?int $placeNumber): self
    {
        $this->placeNumber = $placeNumber;

        return $this;
    }
}
