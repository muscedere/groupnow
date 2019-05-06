<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="activities")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ad", mappedBy="activity")
     */
    private $ad;

    public function __construct()
    {
        $this->ad = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Ad[]
     */
    public function getAd(): Collection
    {
        return $this->ad;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ad->contains($ad)) {
            $this->ad[] = $ad;
            $ad->setActivity($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ad->contains($ad)) {
            $this->ad->removeElement($ad);
            // set the owning side to null (unless already changed)
            if ($ad->getActivity() === $this) {
                $ad->setActivity(null);
            }
        }

        return $this;
    }
}
