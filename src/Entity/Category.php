<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Idea", mappedBy="category")
     */
    private $ideas;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $travelAdventure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entertainment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $humanRelations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $others;


    public function __construct()
    {
        $this->ideas = new ArrayCollection();
    }

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

    public function getTravelAdventure(): ?string
    {
        return $this->travelAdventure;
    }

    public function setTravelAdventure(?string $travelAdventure): self
    {
        $this->travelAdventure = $travelAdventure;

        return $this;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setSport(?string $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getEntertainment(): ?string
    {
        return $this->entertainment;
    }

    public function setEntertainment(?string $entertainment): self
    {
        $this->entertainment = $entertainment;

        return $this;
    }

    public function getHumanRelations(): ?string
    {
        return $this->humanRelations;
    }

    public function setHumanRelations(?string $humanRelations): self
    {
        $this->humanRelations = $humanRelations;

        return $this;
    }

    public function getOthers(): ?string
    {
        return $this->others;
    }

    public function setOthers(?string $others): self
    {
        $this->others = $others;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdeas()
    {
        return $this->ideas;
    }

    /**
     * @param mixed $ideas
     */
    public function setIdeas($ideas): void
    {
        $this->ideas = $ideas;
    }


}
