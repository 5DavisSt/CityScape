<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		$faker = Factory::create("en_US");

		// "Pages" category
        /* $pages = new Category();
		$pages->setName("Pages");
		$pages->setSlug("pages");
		$pages->setMetaTitle($faker->sentence(5));
		$pages->setMetaDescription($faker->paragraph());
        $manager->persist($pages);
		
        $property = new Category();
		$property->setName("Property");
		$property->setSlug("property");
		$property->setMetaTitle($faker->sentence(5));
		$property->setMetaDescription($faker->paragraph());
		$property->setParent($pages);
        $manager->persist($property);
		
        $propertySide = new Category();
		$propertySide->setName("Property");
		$propertySide->setSlug("property-side");
		$propertySide->setMetaTitle($faker->sentence(5));
		$propertySide->setMetaDescription($faker->paragraph());
		$propertySide->setParent($pages);
        $manager->persist($propertySide);
		
        $propertyDetails = new Category();
		$propertyDetails->setName("Property Details");
		$propertyDetails->setSlug("property-details");
		$propertyDetails->setMetaTitle($faker->sentence(5));
		$propertyDetails->setMetaDescription($faker->paragraph());
		$propertyDetails->setParent($pages);
        $manager->persist($propertyDetails);
		
        $addNewListing = new Category();
		$addNewListing->setName("Add New Listing");
		$addNewListing->setSlug("add-new-listing");
		$addNewListing->setMetaTitle($faker->sentence(5));
		$addNewListing->setMetaDescription($faker->paragraph());
		$addNewListing->setParent($pages);
        $manager->persist($addNewListing);
		
        $aboutUs = new Category();
		$aboutUs->setName("About Us");
		$aboutUs->setSlug("about-us");
		$aboutUs->setMetaTitle($faker->sentence(5));
		$aboutUs->setMetaDescription($faker->paragraph());
		$aboutUs->setParent($pages);
        $manager->persist($aboutUs);
		
        $faq = new Category();
		$faq->setName("FAQ");
		$faq->setSlug("faq");
		$faq->setMetaTitle($faker->sentence(5));
		$faq->setMetaDescription($faker->paragraph());
		$faq->setParent($pages);
        $manager->persist(faq);
		
        $checkout = new Category();
		$checkout->setName("Checkout");
		$checkout->setSlug("checkout");
		$checkout->setMetaTitle($faker->sentence(5));
		$checkout->setMetaDescription($faker->paragraph());
		$checkout->setParent($pages);
        $manager->persist($checkout);

		$cart = new Category();
		$cart->setName("Cart");
		$cart->setSlug("cart");
		$cart->setMetaTitle($faker->sentence(5));
		$cart->setMetaDescription($faker->paragraph());
		$cart->setParent($pages);
        $manager->persist($cart);

        $project = new Category();
		$project->setName("Project");
		$project->setSlug("project");
		$project->setMetaTitle($faker->sentence(5));
		$project->setMetaDescription($faker->paragraph());
        $manager->persist($project);

		$projectSide = new Category();
		$projectSide->setName("Project");
		$projectSide->setSlug("project-side");
		$projectSide->setMetaTitle($faker->sentence(5));
		$projectSide->setMetaDescription($faker->paragraph());
		$projectSide->setParent($project);
        $manager->persist($projectSide);

		$projectDetails = new Category();
		$projectDetails->setName("Project Details");
		$projectDetails->setSlug("project-details");
		$projectDetails->setMetaTitle($faker->sentence(5));
		$projectDetails->setMetaDescription($faker->paragraph());
		$projectDetails->setParent($project);
        $manager->persist($projectDetails);

        $blog = new Category();
		$blog->setName("Blog");
		$blog->setSlug("blog");
		$blog->setMetaTitle($faker->sentence(5));
		$blog->setMetaDescription($faker->paragraph());
        $manager->persist($blog);

        $blogClassic = new Category();
		$blogClassic->setName("Blog Classic");
		$blogClassic->setSlug("blog-classic");
		$blogClassic->setMetaTitle($faker->sentence(5));
		$blogClassic->setMetaDescription($faker->paragraph());
		$blogClassic->setParent($blog);
        $manager->persist($blogClassic);

        $blogDetails = new Category();
		$blogDetails->setName("Blog Details");
		$blogDetails->setSlug("blog-details");
		$blogDetails->setMetaTitle($faker->sentence(5));
		$blogDetails->setMetaDescription($faker->paragraph());
		$blogDetails->setParent($blog);
        $manager->persist($blogDetails);

        $contact = new Contact();
		$contact->setName("Contact Us");
		$contact->setSlug("contact");
		$contact->setMetaTitle($faker->sentence(5));
		$contact->setMetaDescription($faker->paragraph());
        $manager->persist($contact); */
		
        $categories = [
            [
                'main_categories' => 'Page',
                'sub_category_array' => [
                    'Property',
                    'Property Sidebar',
                    'Property Details',
                    'Add New Listing',
                    'About Us',
                    'FAQ',
                    'CheckOut',
                    'Cart'
                ]
            ],
        
            [
                'main_categories' => 'Projects',
                'sub_category_array' => [
                    'Project',
                    'Project Details'
                ]
            ],
        
            [
                'main_categories' => 'Blog',
                'sub_category_array' => [
                    'Blog Classic',
                    'Blog Details'
                ]
            ],
        
            [
                'main_categories' => 'Contact Us',
                'sub_category_array' => []
            ],
        
        ];

        foreach ($categories as $z => $subArray) {
            $mainCategory = new Category();
            $mainCategory->setName($subArray['main_categories']);
            $mainCategory->setSlug($faker->slug());
            $mainCategory->setMetaTitle($faker->sentence(5));
            $mainCategory->setMetaDescription($faker->paragraph());
            $manager->persist($mainCategory);
            
            foreach ($subArray['sub_category_array'] as $k => $subCategoryName) {
                $subCategory = new Category();
                $subCategory->setName($subCategoryName);
                $subCategory->setSlug($faker->slug());
                $subCategory->setMetaTitle($faker->sentence(5));
                $subCategory->setMetaDescription($faker->paragraph());
                $subCategory->setParent($mainCategory);
                $manager->persist($subCategory);

                $this->setReference('category_' . $k, $subCategory);
			};

            $manager->flush();
        };
		
        // $manager->flush();
    }
}
