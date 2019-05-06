<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


class AdSearch
{


    private $maxPrice;

    private $minPlace;
    /**
     * @var Collection
     */
    private $place;

    /**
     * @var ArrayCollection
     */
    private $category;

    /**
     * @var Collection
     */
    private $activity;

    public function __construct()
    {
        $this->place = new ArrayCollection();
        $this->activity = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getCategory(): ?Collection
    {
        return $this->category;
    }

    public function setCategory(?Collection $category): void
    {
        $this->category = $category;

    }

    public function getActivity(): ArrayCollection
    {
        return $this->activity;
    }

    public function setActivity(ArrayCollection $activity): self
    {
        $this->activity = $activity;

    }

    public function getmaxPrice(): ?int 
    {
        return $this->maxPrice;
    }

    public function setmaxPrice(?int $maxPrice): AdSearch
    {
        $this->maxPrice = $maxPrice;

        return $this;

    }
    public function getminPlace(): ?int 
    {
        return $this->minPlace;
    }

    public function setminPlace(?int $minPlace): AdSearch
    {
        $this->minPlace = $minPlace;

        return $this;

    }

   
}
