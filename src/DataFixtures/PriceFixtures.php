<?php

namespace App\DataFixtures;


use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PriceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 4; $i++) {
            $perform = new Price();
            $perform->setTarget($faker->title());
            $perform->setUnit($faker->boolean());
            $perform->setWeek($faker->randomFloat(1,0,12));
            $perform->setWeekend($faker->randomFloat(1,0,15));

            $manager->persist($perform);
            $this->addReference('price_' . $i, $perform);
        }

        $manager->flush();

    }
}
