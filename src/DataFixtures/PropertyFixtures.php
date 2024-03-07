<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Picture;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{	
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('en_US');
        
		// We create 25 new properties
        for ($ii = 1; $ii < 25; $ii++) {
            $property = new Property();
            $property->setPropHousingType($faker->randomElement(["house", "single_family", "apartment", "office", "villa", "luxury_home", "studio"]));
            $property->setPropNbRooms($faker->numberBetween(0, 100));
            $property->setPropSqm($faker->numberBetween(0, 100000));
            $property->setPropPrice($faker->numberBetween(0, 10000000));
            $property->setPropNbBeds($faker->numberBetween(0, 100));
            $property->setPropNbBaths($faker->numberBetween(0, 100));
            $property->setPropNbSpaces($faker->numberBetween(0, 100));
            $property->setPropFurnished($faker->boolean());
            //$property->setCategory($this->getReference('category_'.$ii));
			
			$manager->persist($property);
			
			for ($i = 0; $i <2; $i++) {
				$url ='https://picsum.photos/1290/584';
				$imageName = rand(1,1000).'.jpg';
				$img = 'C:\Users\steve\cityscape\public\assets\images\properties/'.$imageName;
				file_put_contents($img, file_get_contents($url));

				$picture = new Picture();
				$picture->setImageName($imageName);
				$picture->setProperty($property);

				$manager->persist($picture);
			};
        }

        $manager->flush();
    }
}