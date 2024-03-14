<?php

namespace App\DataFixtures;

use App\Entity\Picture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
	//public const PICTURE_REFERENCE = 'picture';
	
    public function load(ObjectManager $manager): void
    {
		// We create 50 new pictures
		for ($i = 1; $i < 51; $i++) {
			$url ='https://picsum.photos/1290/584';
			$picName = rand(1,1000).'.jpg';
			$img = 'C:\Users\steve\cityscape\public\assets\images\properties/'.$picName;
			file_put_contents($img, file_get_contents($url));

			$picture = new Picture();
			$picture->setPicName($picName);
			//$picture->setProperty($picture->property);

			$this->setReference('picture'.$i, $picture);

			$manager->persist($picture);
		};
		
        $manager->flush();
    }
}
