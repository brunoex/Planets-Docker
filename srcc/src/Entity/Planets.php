<?php

namespace App\Entity;

use App\Repository\PlanetsRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=PlanetsRepository::class)
 */
class Planets
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
    private $name;

    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $day;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $month;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function setDay($day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function setMonth($month): self
    {
        $this->month = $month;

        return $this;
    }
}
