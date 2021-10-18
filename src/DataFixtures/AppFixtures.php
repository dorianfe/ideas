<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        $category = new Category();
//        $category->setName("sport");
//        $manager->persist($category);
        $categories = ["Sport", "Aventure", "caca"];
        for ($i = 0; $i < 3; $i++) {
            $category = new Category();
            $category->setName($categories[$i]);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
