<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Type\Decimal;

/**
 * @ORM\Entity(repositoryClass=PizzaRepository::class)
 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
 */
class Pizza
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
     * @var string $name
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @var Decimal $price
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @var Recipe $Recipe
     */
    private $Recipe;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, mappedBy="pizza")
     * @var Recipe $recipes
     */
    private $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRecipe(): ?string
    {
        return $this->Recipe;
    }

    public function setRecipe(string $Recipe): self
    {
        $this->Recipe = $Recipe;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (! $this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->addPizza($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            $recipe->removePizza($this);
        }

        return $this;
    }
}
