<?php

namespace App\Controller\Admin;

use App\Entity\Project;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

	public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Projets')
            ->setEntityLabelInSingular('un projet')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('projTitle', 'Nom du projet'),
            TextField::new('projClient', 'Nom du client'),
            MoneyField::new('projPrice', 'Prix')->setCurrency('EUR'),
            DateField::new('projDate', 'Date estimée du projet'),
            TextField::new('projFacebook', 'Facebook'),
            TextField::new('projTwitter', 'Twitter'),
            TextField::new('projLinkedin', 'Instagram'),
            ArrayField::new('projCategory', 'Catégorie(s)')
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('projTitle'))
			->add(TextFilter::new('projClient'))
			->add(NumericFilter::new('projPrice'))
			->add(DateTimeFilter::new('projDate'))
			->add(TextFilter::new('projFacebook'))
			->add(TextFilter::new('projTwitter'))
			->add(TextFilter::new('projLinkedin'))
			->add(ArrayFilter::new('projCategory'))
        ;
    }
}
