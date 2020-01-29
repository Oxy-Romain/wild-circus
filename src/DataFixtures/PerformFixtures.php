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

        for ($i = 1; $i <= 15; $i++) {
            $perform = new Perform();
            $perform->setTitle($faker->title());
            $perform->setDescription($faker->text());
            $perform->setImage($faker->image());

            $manager->persist($perform);
            $this->addReference('perform_' . $i, $perform);
        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [PerformFixtures::class];
    }
}
