<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create("en_US");

		// We create 25 new users
        for ($i = 0; $i < 25; $i++) {
            $user = new User();
            $user->setFirstName($faker->firstName($gender = null));
            $user->setLastName($faker->lastName());
            $user->setUserName($faker->userName());
            $user->setEmail($faker->email());
            $user->setRoles($faker->randomElements(["admin", "client"]));
            $user->setPassword($faker->password());
            $user->setIsVerified($faker->boolean());
            $manager->persist($user);
        }

        $manager->flush();
    }
}
