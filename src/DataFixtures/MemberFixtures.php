<?php

namespace App\DataFixtures;


use App\Entity\member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class MemberFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 15; $i++) {
            $member = new member();
            $member->setName($faker->name());
            $member->setJob($faker->word());
            $member->setImage($faker->image());

            $manager->persist($member);
            $this->addReference('member_' . $i, $member);
        }

        $manager->flush();

    }
}
