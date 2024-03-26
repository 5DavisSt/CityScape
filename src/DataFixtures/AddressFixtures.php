<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');

        // We create 25 new addresses
        
        for ($i = 0; $i < 25; $i++) {
            $address = new Address();
            $address->setAddNbStreet($faker->buildingNumber());
            $address->setAddAddressLine1($faker->streetName());
            $address->setAddAddressLine2($faker->secondaryAddress());
            $address->setAddCity($faker->city());
            $address->setAddState($faker->state());
            $address->setAddZip($faker->randomNumber(6, true));
            $address->setAddCountry($faker->randomElement(['bangladesh', 'japan', 'korea', 'singapore', 'germany', 'thailand']));
            $manager->persist($address);
        }
		
        $manager->flush();
    }
}
