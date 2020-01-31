<?php

namespace App\DataFixtures;


use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class MemberFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $member = new Member();
            $member->setName($faker->name());
            $member->setJob($faker->word());
            $member->setImage($faker->imageUrl());
            $member->setPerform($this->getReference('perform_' . rand(1,6)));

            $manager->persist($member);
            $this->addReference('member_' . $i, $member);
        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [PerformFixtures::class];
    }
}
