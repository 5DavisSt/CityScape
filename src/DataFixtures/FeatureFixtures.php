<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Feature;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FeatureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create("en_US");

		// We create 25 new features
        for ($i = 0; $i < 25; $i++) {
            $feature = new Feature();
            $feature->setFeatTitle($faker->sentence(5));
            $manager->persist($feature);
        }
		
        $manager->flush();
    }
	
	public function getDependencies()
    {
        return [PropertyFixtures::class];
    }
}
