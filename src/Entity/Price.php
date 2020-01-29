<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * max = 255,
     * maxMessage = "Le code bar ne doit pas excéder {{ limit }} caractères.")
     */
    private $target;

    /**
     * @ORM\Column(type="boolean")
     */
    private $unit;

    /**
     * @ORM\Column(type="float")
     */
    private $week;

    /**
     * @ORM\Column(type="float")
     */
    private $weekend;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function setTarget(string $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function getUnit(): ?bool
    {
        return $this->unit;
    }

    public function setUnit(bool $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getWeek(): ?float
    {
        return $this->week;
    }

    public function setWeek(float $week): self
    {
        $this->week = $week;

        return $this;
    }

    public function getWeekend(): ?float
    {
        return $this->weekend;
    }

    public function setWeekend(float $weekend): self
    {
        $this->weekend = $weekend;

        return $this;
    }
}
