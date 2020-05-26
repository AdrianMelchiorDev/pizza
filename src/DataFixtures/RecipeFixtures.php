<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public const RECIPE_REFERENCE = 'recipe';

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Recipe::class, 10, function (Recipe $recipe, $count) {
            $recipe->setName('Recipe ' . $count);
            $recipe->setCookingTime($this->faker->randomFloat(2, 0, 60));
            $recipe->addIngredient($this->getReference(Ingredient::class . '_' . $this->faker->randomNumber(1)));
            $recipe->addIngredient($this->getReference(Ingredient::class . '_' . $this->faker->randomNumber(1)));
            $recipe->addIngredient($this->getReference(Ingredient::class . '_' . $this->faker->randomNumber(1)));
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            IngredientFixtures::class
        ];
    }
}
