<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		// "Pages" category
        $pages = new Category();
		$pages->setName("Pages");
		$pages->setSlug("pages");
		$pages->setMetaTitle("");
		$pages->setMetaDescription("");
		$pages->setParent($pages);
        $manager->persist($pages);
		
        $property = new Category();
		$property->setName("Property");
		$property->setSlug("property");
		$property->setMetaTitle("");
		$property->setMetaDescription("");
		$property->setParent($pages);
        $manager->persist($property);
		
        $propertySide = new Category();
		$propertySide->setName("Property");
		$propertySide->setSlug("property-side");
		$propertySide->setMetaTitle("");
		$propertySide->setMetaDescription("");
		$propertySide->setParent($property);
        $manager->persist($propertySide);
		
        $propertyDetails = new Category();
		$propertyDetails->setName("Property Details");
		$propertyDetails->setSlug("property-details");
		$propertyDetails->setMetaTitle("");
		$propertyDetails->setMetaDescription("");
		$propertyDetails->setParent($property);
        $manager->persist($propertyDetails);
		
        $addNewListing = new Category();
		$addNewListing->setName("Add New Listing");
		$addNewListing->setSlug("add-new-listing");
		$addNewListing->setMetaTitle("");
		$addNewListing->setMetaDescription("");
		$addNewListing->setParent($pages);
        $manager->persist($addNewListing);
		
        $aboutUs = new Category();
		$aboutUs->setName("About Us");
		$aboutUs->setSlug("about-us");
		$aboutUs->setMetaTitle("");
		$aboutUs->setMetaDescription("");
		$aboutUs->setParent($pages);
        $manager->persist($aboutUs);
		
        $faq = new Category();
		$faq->setName("FAQ");
		$faq->setSlug("faq");
		$faq->setMetaTitle("");
		$faq->setMetaDescription("");
		$faq->setParent($pages);
        $manager->persist(faq);
		
        $checkout = new Category();
		$checkout->setName("Checkout");
		$checkout->setSlug("checkout");
		$checkout->setMetaTitle("");
		$checkout->setMetaDescription("");
		$checkout->setParent($pages);
        $manager->persist($checkout);

		$cart = new Category();
		$cart->setName("Cart");
		$cart->setSlug("cart");
		$cart->setMetaTitle("");
		$cart->setMetaDescription("");
		$cart->setParent($pages);
        $manager->persist($cart);

        $project = new Category();
		$project->setName("Project");
		$project->setSlug("project");
		$project->setMetaTitle("");
		$project->setMetaDescription("");
		$project->setParent($project);
        $manager->persist($project);

/*         $projectSide = new Category();
		$projectSide->setName("Project");
		$projectSide->setSlug("project-side");
		$projectSide->setMetaTitle("");
		$projectSide->setMetaDescription("");
		$projectSide->setParent($project);
        $manager->persist($projectSide);
 */
        $projectDetails = new Category();
		$projectDetails->setName("Project Details");
		$projectDetails->setSlug("project-details");
		$projectDetails->setMetaTitle("");
		$projectDetails->setMetaDescription("");
		$projectDetails->setParent($project);
        $manager->persist($projectDetails);

        $blog = new Category();
		$blog->setName("Blog");
		$blog->setSlug("blog");
		$blog->setMetaTitle("");
		$blog->setMetaDescription("");
		$blog->setParent($blog);
        $manager->persist($blog);

        $blogClassic = new Category();
		$blogClassic->setName("Blog Classic");
		$blogClassic->setSlug("blog-classic");
		$blogClassic->setMetaTitle("");
		$blogClassic->setMetaDescription("");
		$blogClassic->setParent($blog);
        $manager->persist($blogClassic);

        $blogDetails = new Category();
		$blogDetails->setName("Blog Details");
		$blogDetails->setSlug("blog-details");
		$blogDetails->setMetaTitle("");
		$blogDetails->setMetaDescription("");
		$blogDetails->setParent($blog);
        $manager->persist($blogDetails);

        $manager->flush();
    }
}
