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
            $property->setPropTitle($faker->sentence(5));
            $property->setPropHousingType($faker->randomElement(['house', 'single_family', 'apartment', 'office', 'villa', 'luxury_home', 'studio']));
            $property->setPropNbRooms($faker->numberBetween(0, 100));
            $property->setPropSqm($faker->numberBetween(0, 100000));
            $property->setPropPrice($faker->numberBetween(0, 10000000));
            $property->setPropNbBeds($faker->numberBetween(0, 100));
            $property->setPropNbBaths($faker->numberBetween(0, 100));
            $property->setPropNbSpaces($faker->numberBetween(0, 100));
            $property->setPropFurnished($faker->boolean());
            $property->setPropSlug('slug-property'.$i);
			$property->setPropCategory($this->getReference('category_'.rand(1, 5)));
			
			for ($j = 1; $j < 4; $j++) {
				$url = file_get_contents('https://loremflickr.com/985/584/house');
				$picName = rand(1,1000).'.jpg';
				$img = 'C:\Users\steve\cityscape\public\assets\images\properties/'.$picName;
				
				while (!file_exists('C:\Users\steve\cityscape\public\assets\images\properties/'.$picName)) {
					file_put_contents('C:\Users\steve\cityscape\public\assets\images\properties/'.$picName, $url);
				}
				
				$picture = new Picture();
				$picture->setPicName($picName);
				$picture->setPicProperty($property);
				
				//$this->setReference('picture'.$i, $picture);
				
				$manager->persist($picture);
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