<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PictureFixtures extends Fixture //implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
		/*$faker = Factory::create("en_US");*/

		// We create 2 new pictures
        /*for ($i = 0; $i < 2; $i++) {
			$url = "https://picsum.photos/1290/584";
			$imageName = rand(1, 1000).".jpg";
			$img = "../../public/img/".$imageName;
			file_put_contents($img, file_get_contents($url));
			
			$pict = new Picture();
			$picture->setImageName($imageName);
			$picture->setProperty($this->setReference("picture_".rand(0,1));
			
			$manager->persist($picture);
        }*/

        $manager->flush();
    }
	
	/*public function getDependencies()
    {
        return [PropertyFixtures::class];
    }*/
}
