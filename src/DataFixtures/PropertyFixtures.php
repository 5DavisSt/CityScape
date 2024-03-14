<?php

namespace App\DataFixtures;

use Faker\Factory;

use App\Entity\Picture;
use App\Entity\Property;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PropertyFixtures extends Fixture implements DependentFixtureInterface
{	
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');
        
		// We create 25 new properties
        for ($i = 1; $i < 26; $i++) {
            $property = new Property();
            $property->setPropHousingType($faker->randomElement(['house', 'single_family', 'apartment', 'office', 'villa', 'luxury_home', 'studio']));
            $property->setPropNbRooms($faker->numberBetween(0, 100));
            $property->setPropSqm($faker->numberBetween(0, 100000));
            $property->setPropPrice($faker->numberBetween(0, 10000000));
            $property->setPropNbBeds($faker->numberBetween(0, 100));
            $property->setPropNbBaths($faker->numberBetween(0, 100));
            $property->setPropNbSpaces($faker->numberBetween(0, 100));
            $property->setPropFurnished($faker->boolean());
            $property->setPropSlug($faker->slug());
			//$property->setCategory($this->getReference('category_'.$ii));
			
			for ($j = 1; $j < 4; $j++) {
				$property->addPropPicture($this->getReference('picture'.rand(1, 50)));
			}
			
			$manager->persist($property);
        }

        $manager->flush();
    }
	
	public function getDependencies()
    {
        return [PictureFixtures::class];
    }
}