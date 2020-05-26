<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Doctrine\Persistence\ObjectManager;

class PizzaFixtures extends BaseFixtures
{

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Pizza::class, 10, function (Pizza $pizza, $count) {
            $pizza->setName('Pizza ' . $count);
            $pizza->setPrice(mt_rand(1, 10) . '.' . mt_rand(0, 100));
        });

        $manager->flush();
    }
}
