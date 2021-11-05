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
        $categories = ["Travel", "Relationships", "Career", "Financial", "Entertainment", "Adventure", "Contribution", "Creativity", "Education", "Health", "Food"];
        $nbCategories = count($categories);
        for ($i = 0; $i < $nbCategories; $i++) {
            $category = new Category();
            $category->setName($categories[$i]);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
