<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;

use App\Entity\Recipe;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends BaseFixtures/* implements DependentFixtureInterface*/
{
    public const INGREDIENT_REFERENCE = 'ingredient';

    private static $ingredients = ['Mehl', 'Salz', 'Tomaten', 'Salami', 'Käse', 'Hefe', 'Champignons', 'Artischocken', 'Mais', 'Chilli', 'Basilikum', 'Oregano'];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Ingredient::class, 10, function (Ingredient $ingredient, $count) {
            $ingredient->setName(self::$ingredients[$count]);
            $ingredient->setPrice($this->faker->randomFloat(2, 0, 10));
        });

        $manager->flush();
    }

//    public function getDependencies()
//    {
//        return [
////            RecipeFixtures::class
//        ];
//    }
}
