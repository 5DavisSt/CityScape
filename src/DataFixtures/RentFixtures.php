<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Rent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create('en_US');

		// We create 25 new renting files
        for ($i = 0; $i < 25; $i++) {
            $rent = new Rent();
            $rent->setRentStart($faker->dateTime());
            $rent->setRentEnd($faker->dateTime());
            $rent->setRentPrice($faker->numberBetween(0, 10000000));
            $manager->persist($rent);
        }
		
        $manager->flush();
    }

	public function getDependencies()
    {
        return [UserFixtures::class, PropertyFixtures::class];
    }
}
