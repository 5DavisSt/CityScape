<?php

namespace App\DataFixtures;

use Faker\Factory;

use App\Entity\Address;
use App\Entity\Amenity;
use App\Entity\Country;
use App\Entity\Feature;
use App\Entity\Picture;
use App\Entity\Project;
use App\Entity\Property;
use App\Entity\Rent;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create("en_US");

		// We call the entities without any foreign keys first, then the rest
		
		// We create 25 new users
        for ($i = 0; $i < 25; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setRoles($faker->randomElements(["admin", "client"]));
            $user->setPassword($faker->password());
            $user->setIsVerified($faker->boolean());
            $manager->persist($user);
        }

		// We create 25 new properties
        for ($i = 0; $i < 25; $i++) {
            $property = new Property();
            $property->setPropHousingType($faker->randomElement(["house", "single_family", "apartment", "office", "villa", "luxury_home", "studio"]));
            $property->setPropNbRooms($faker->numberBetween(0, 100));
            $property->setPropSQM($faker->numberBetween(0, 100000));
            $property->setPropPrice($faker->numberBetween(0, 10000000));
            $property->setCreatedAt(new \DateTimeImmutable());			
            $property->setPropNbBeds($faker->numberBetween(0, 100));
            $property->setPropNbBaths($faker->numberBetween(0, 100));
            $property->setPropNbSpaces($faker->numberBetween(0, 100));
            $property->setPropFurnished($faker->boolean());
            $manager->persist($property);
        }

		// We create 25 new countries
        for ($i = 0; $i < 25; $i++) {
            $country = new Country();
            $country->setCtName(randomElement(["bangladesh", "japan", "korea", "singapore", "germany", "thailand"]));
            $manager->persist($country);
        }

		// We create 25 new projects
        for ($i = 0; $i < 25; $i++) {
            $project = new Project();
            $project->setProjClient($faker->name($gender = null|"male"|"female"));
            $project->setProjPrice($faker->numberBetween(0, 10000000));
            $project->setProjCategory($faker->randomElement(["Planning", "Real Estate"]));
            $project->setProjDate($faker->dateTime());
            $project->setProjFacebook("https://facebook.com/");
            $project->setProjTwitter("https://twitter.com/");
            $project->setProjLinkedin("https://linkedin.com/");
            $project->setProjInstagram("https://instagram.com/");
            $project->setProjTitle($faker->sentence(5));
            $manager->persist($project);
        }
		
		// We create 25 new amenities
        for ($i = 0; $i < 25; $i++) {
            $amenity = new Amenity();
            $amenity->setAmenDishwasher($faker->boolean());
            $amenity->setAmenFloorCoverings($faker->boolean());
            $amenity->setAmenInternet($faker->boolean());
            $amenity->setAmenWardrobes($faker->boolean());
            $amenity->setAmenSupermarket($faker->boolean());
            $amenity->setAmenKidsZone($faker->boolean());
            $manager->persist($amenity);
        }
		
		// We create 25 new pictures
        for ($i = 0; $i < 25; $i++) {
            $picture = new Picture();
            $picture->setPicFile($faker->word());
            $picture->setPicName($faker->word());
            $picture->setPicHref("assets/");
            $picture->setPicAlt($faker->sentence(5));
            $picture->setPicCaption($faker->sentence(5));
            $picture->setPicType($faker->numberBetween(0, 5));
            $picture->setPicFormat($faker->randomElement(["jpeg", "jpg", "png", "gif", "bmp", "svg"]));
            $picture->setPicWidth($faker->numberBetween(0, 1920));
            $picture->setPicHeight($faker->numberBetween(0, 1080));
            $picture->setPicSize($faker->randomFloat(2));
            $manager->persist($picture);
        }

		// We create 25 new features
        for ($i = 0; $i < 25; $i++) {
            $feature = new Feature();
            $feature->setFeatTitle($faker->sentence(5));
            $manager->persist($feature);
        }
		
		// We create 25 new addresses
        for ($i = 0; $i < 25; $i++) {
            $address = new Address();
            $address->setAddNbStreet($faker->buildingNumber());
            $address->setAddAddressLine1($faker->streetName());
            $address->setAddAddressLine2($faker->secondaryAddress());
            $address->setAddCity($faker->city());
            $address->setAddState($faker->state());
            $address->setAddZip($faker->postcode());
            $manager->persist($address);
        }
		
		// We create 25 new renting files
        for ($i = 0; $i < 25; $i++) {
            $rent = new Rent();
            $rent->setRentStart($faker->dateTime());
            $rent->setRentEnd($faker->dateTime());
            $rent->setRentPrice($faker->numberBetween(0, 10000000));
            $manager->persist($rent);
        }
		
        $manager->flush();
    }
}
