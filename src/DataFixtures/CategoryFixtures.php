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
		$faker = Factory::create('en_US');

		// "Pages" category
        $property = new Category();
		$property->setCatName("property");
		$property->setCatTitle("Property");
		$property->setCatSlug("property");
		$property->setCatMetaTitle($faker->sentence(5));
		$property->setCatMetaDescription($faker->paragraph());
        $manager->persist($property);
		
        $propertySide = new Category();
		$propertySide->setCatName("property_sidebar");
		$propertySide->setCatTitle("Property Sidebar");
		$propertySide->setCatSlug("sidebar");
		$propertySide->setCatMetaTitle($faker->sentence(5));
		$propertySide->setCatMetaDescription($faker->paragraph());
		$propertySide->setParent($property);
        $manager->persist($propertySide);
		$this->setReference('category_1', $propertySide);
		
        $propertyDetails = new Category();
		$propertyDetails->setCatName("property_details");
		$propertyDetails->setCatTitle("Property Details");
		$propertyDetails->setCatSlug("details");
		$propertyDetails->setCatMetaTitle($faker->sentence(5));
		$propertyDetails->setCatMetaDescription($faker->paragraph());
		$propertyDetails->setParent($property);
        $manager->persist($propertyDetails);
		$this->setReference('category_2', $propertyDetails);
		
        $project = new Category();
		$project->setCatName("project");
		$project->setCatTitle("Project");
		$project->setCatSlug("project");
		$project->setCatMetaTitle($faker->sentence(5));
		$project->setCatMetaDescription($faker->paragraph());
        $manager->persist($project);

		$projectSide = new Category();
		$projectSide->setCatName("project");
		$projectSide->setCatTitle("Project Sidebar");
		$projectSide->setCatSlug("sidebar");
		$projectSide->setCatMetaTitle($faker->sentence(5));
		$projectSide->setCatMetaDescription($faker->paragraph());
		$projectSide->setParent($project);
        $manager->persist($projectSide);
		$this->setReference('category_1', $projectSide);

		$projectDetails = new Category();
		$projectDetails->setCatName("project_details");
		$projectDetails->setCatTitle("Project Details");
		$projectDetails->setCatSlug("details");
		$projectDetails->setCatMetaTitle($faker->sentence(5));
		$projectDetails->setCatMetaDescription($faker->paragraph());
		$projectDetails->setParent($project);
        $manager->persist($projectDetails);
		$this->setReference('category_2', $projectDetails);

        $blog = new Category();
		$blog->setCatName("blog");
		$blog->setCatTitle("Blog");
		$blog->setCatSlug("blog");
		$blog->setCatMetaTitle($faker->sentence(5));
		$blog->setCatMetaDescription($faker->paragraph());
        $manager->persist($blog);

        $blogClassic = new Category();
		$blogClassic->setCatName("blog_classic");
		$blogClassic->setCatTitle("Blog Classic");
		$blogClassic->setCatSlug("classic");
		$blogClassic->setCatMetaTitle($faker->sentence(5));
		$blogClassic->setCatMetaDescription($faker->paragraph());
		$blogClassic->setParent($blog);
        $manager->persist($blogClassic);
		$this->setReference('category_1', $blogClassic);

        $blogDetails = new Category();
		$blogDetails->setCatName("blog_details");
		$blogDetails->setCatTitle("Blog Details");
		$blogDetails->setCatSlug("details");
		$blogDetails->setCatMetaTitle($faker->sentence(5));
		$blogDetails->setCatMetaDescription($faker->paragraph());
		$blogDetails->setParent($blog);
        $manager->persist($blogDetails);
		$this->setReference('category_2', $blogDetails);
		
		$other = new Category();
		$other->setCatName("other");
		$other->setCatTitle("Other Pages");
		$other->setCatSlug("other-pages");
		$other->setCatMetaTitle($faker->sentence(5));
		$other->setCatMetaDescription($faker->paragraph());
        $manager->persist($other);
		
		$addNewListing = new Category();
		$addNewListing->setCatName("add_new_listing");
		$addNewListing->setCatTitle("Add New Listing");
		$addNewListing->setCatSlug("add-new-listing");
		$addNewListing->setCatMetaTitle($faker->sentence(5));
		$addNewListing->setCatMetaDescription($faker->paragraph());
		$addNewListing->setParent($other);
        $manager->persist($addNewListing);
		$this->setReference('category_1', $addNewListing);
		
        $aboutUs = new Category();
		$aboutUs->setCatName("about");
		$aboutUs->setCatTitle("About Us");
		$aboutUs->setCatSlug("about-us");
		$aboutUs->setCatMetaTitle($faker->sentence(5));
		$aboutUs->setCatMetaDescription($faker->paragraph());
		$aboutUs->setParent($other);
        $manager->persist($aboutUs);
		$this->setReference('category_2', $aboutUs);
		
        $faq = new Category();
		$faq->setCatName("faq");
		$faq->setCatTitle("FAQ");
		$faq->setCatSlug("faq");
		$faq->setCatMetaTitle($faker->sentence(5));
		$faq->setCatMetaDescription($faker->paragraph());
		$faq->setParent($other);
        $manager->persist($faq);
		$this->setReference('category_3', $faq);
		
        $checkout = new Category();
		$checkout->setCatName("checkout");
		$checkout->setCatTitle("Checkout");
		$checkout->setCatSlug("checkout");
		$checkout->setCatMetaTitle($faker->sentence(5));
		$checkout->setCatMetaDescription($faker->paragraph());
		$checkout->setParent($other);
        $manager->persist($checkout);
		$this->setReference('category_4', $checkout);

		$cart = new Category();
		$cart->setCatName("cart");
		$cart->setCatTitle("Cart");
		$cart->setCatSlug("cart");
		$cart->setCatMetaTitle($faker->sentence(5));
		$cart->setCatMetaDescription($faker->paragraph());
		$cart->setParent($other);
		$manager->persist($cart);
		$this->setReference('category_5', $cart);
		
        /*$categories = [
            [
                'main_categories' => 'Propriétés',
                'main_names' => 'property',
                'sub_category_array' => [
                    'Property',
                    'Property Sidebar',
                    'Property Details'
                ],
				'sub_names_array' => [
                    'property_sidebar',
                    'property_details'
                ]
            ],
        
            [
                'main_categories' => 'Projects',
                'main_names' => 'projects',
                'sub_category_array' => [
                    'Project',
                    'Project Details'
                ],
				'sub_names_array' => [
                    'project',
                    'project_details'
                ]
            ],
        
            [
                'main_categories' => 'Blog',
                'main_names' => 'blog',
                'sub_category_array' => [
                    'Blog Classic',
                    'Blog Details'
                ],
				'sub_names_array' => [
                    'blog_classic',
                    'blog_details'
                ]

            ],
			
            [
                'main_categories' => 'Other',
                'main_names' => 'other',
                'sub_category_array' => [
                    'add_new_listing',
                    'about',
                    'faq',
                    'checkout',
                    'cart'
                ],
				'sub_names_array' => [
                    'Add New Listing',
                    'About Us',
                    'FAQ',
                    'CheckOut',
                    'Cart'
                ]

            ],			
        ];

        foreach ($categories as $z => $subArray) {
            $mainCategory = new Category();
            $mainCategory->setCatName($subArray['main_names']);
            $mainCategory->setCatTitle($subArray['main_categories']);
            $mainCategory->setCatSlug($faker->slug());
            $mainCategory->setCatMetaTitle($faker->sentence(5));
            $mainCategory->setCatMetaDescription($faker->sentence(7));
            $manager->persist($mainCategory);
            
            foreach ($subArray['sub_category_array'] as $k => $subCategoryName) {
                $subCategory = new Category();
                $subCategory->setCatName($subCategoryName);
                $subCategory->setCatTitle($subCategoryName);
                $subCategory->setCatSlug($faker->slug());
                $subCategory->setCatMetaTitle($faker->sentence(5));
                $subCategory->setCatMetaDescription($faker->sentence(7));
                $subCategory->setParent($mainCategory);
                $manager->persist($subCategory);

                $this->setReference('category_'.$k, $subCategory);
			};

            $manager->flush();
        };*/
		
        $manager->flush();
    }
}
