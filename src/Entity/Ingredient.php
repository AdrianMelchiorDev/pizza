<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int $id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @var string $name
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     * @Assert\NotBlank
     * @var Decimal $price
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, inversedBy="ingredients")
     * @var recipe $recipe
     */
    private $recipe;

    public function __construct()
    {
        $this->recipe = new ArrayCollection();
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

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipe(): Collection
    {
        return $this->recipe;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (! $this->recipe->contains($recipe)) {
            $this->recipe[] = $recipe;
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipe->contains($recipe)) {
            $this->recipe->removeElement($recipe);
        }

        return $this;
    }

    public function getPrice(): ?string
    {
        return str_replace('.', ',', $this->price);
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function __toString()
    {
        return $this->name . '(' . $this->getPrice() . '€)';
    }
}
