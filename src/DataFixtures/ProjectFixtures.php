<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create("en_US");

		// We create 25 new projects
        for ($i = 0; $i < 25; $i++) {
            $project = new Project();
            $project->setProjClient($faker->name($gender = null));
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

        $manager->flush();
    }
}
