<?php

namespace App\Controller\Admin;

use App\Entity\Category;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

	public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Catégories')
            ->setEntityLabelInSingular('une catégorie')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('catName', 'Nom de la catégorie'),
            TextField::new('catSlug', 'Slug utilisé'),
            TextField::new('catMetaTitle', 'Méta-titre'),
            TextEditorField::new('catMetaDescription', 'Méta-description')
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('catName'))
			->add(TextFilter::new('catSlug'))
			->add(TextFilter::new('catMetaTitle'))
			->add(TextFilter::new('catMetaDescription'))
        ;
    }
}