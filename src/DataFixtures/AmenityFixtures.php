<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Amenity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AmenityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create('en_US');

		// We create 25 new amenities
        for ($i = 0; $i < 25; $i++) {
            $amenity = new Amenity();
            $amenity->setAmenDishwasher($faker->boolean());
            $amenity->setAmenFloorCoverings($faker->boolean());
            $amenity->setAmenInternet($faker->boolean());
            $amenity->setAmenWardrobes($faker->boolean());
            $amenity->setAmenSupermarket($faker->boolean());
            $amenity->setAmenKidsZone($faker->boolean());
            $manager->persist($amenity);
        }

        $manager->flush();
    }

	public function getDependencies()
    {
        return [PropertyFixtures::class];
    }
}
