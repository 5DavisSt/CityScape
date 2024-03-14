<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
	public function __construct (private UserPasswordHasherInterface $userPasswordHasher) {
		// Rien…?
	}
	
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create('en_US');
		
		// We create 1 administrator
		$admin = new User();
		$admin->setFirstName('Ad');
		$admin->setLastName('Min');
		$admin->setUserName('admin');
		$admin->setEmail('admin@admin.com');
		$admin->setRoles(['ROLE_ADMIN']);
		$admin->setPassword($this->userPasswordHasher->hashPassword($admin, 'admin'));
		$manager->persist($admin);

		// We create 25 new users
        for ($i = 0; $i < 25; $i++) {
            $user = new User();
            $user->setFirstName($faker->firstName($gender = null));
            $user->setLastName($faker->lastName());
            $user->setUserName($faker->userName());
            $user->setEmail($faker->email());
            //$user->setRoles($faker->randomElements(['ROLE_ADMIN', 'ROLE_USER']));
            $user->setPassword(($this->userPasswordHasher->hashPassword($user, $faker->password())));
            $user->setIsVerified($faker->boolean());
            $manager->persist($user);
        }

        $manager->flush();
    }
}
