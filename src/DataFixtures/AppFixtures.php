<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        // create 20 products! Bam!
//        for ($i = 0; $i < 20; $i++) {
//            $ingredient = new Ingredient();
//            $ingredient->setName('Ingredient '.$i);
//            $ingredient->setPrice(mt_rand(1, 10) . '.' . mt_rand(0,100));
//            $manager->persist($ingredient);
//        }
//        // $manager->persist($product);

        $manager->flush();
    }
}
