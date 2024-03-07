<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create("en_US");

		// We create 25 new countries
        for ($i = 0; $i < 25; $i++) {
            $country = new Country();
            $country->setCtName($faker->randomElement(["bangladesh", "japan", "korea", "singapore", "germany", "thailand"]));
            $manager->persist($country);
        }

        $manager->flush();
    }
}
