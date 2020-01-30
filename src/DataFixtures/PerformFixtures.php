<?php

namespace App\DataFixtures;


use App\Entity\Perform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PerformFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $perform = new Perform();
            $perform->setTitle($faker->title());
            $perform->setDescription($faker->text());
            $perform->setImage($faker->imageUrl());

            $manager->persist($perform);
            $this->addReference('perform_' . $i, $perform);
        }

        $manager->flush();

    }
}
