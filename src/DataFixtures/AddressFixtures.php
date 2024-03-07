<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		// Creates 25 addresses
        /* for ($i = 0; $i < 25; $i++) {
            $address = new Address();
            $address->setName('Address '.$i);
            $address->setPrice(mt_rand(10, 100));
            $manager->persist($address);
        } */
		
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
