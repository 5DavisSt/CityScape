<?php

namespace App\Controller\Admin;

use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
	
	public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('un utilisateur')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
			TextField::new('userName', 'Nom d\'utilisateur'),
            EmailField::new('email', 'Courriel'),
			TextField::new('firstName', 'Prénom'),
 			TextField::new('lastName', 'Nom'),
			ArrayField::new('roles', 'Rôle(s)'),
			BooleanField::new('isVerified', 'Vérifié ?')
        ];
    }
	
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
			->add(TextFilter::new('userName'))
			->add(TextFilter::new('email', 'Adresse courriel'))
			->add(TextFilter::new('firstName'))
			->add(TextFilter::new("lastName"))
			->add(ArrayFilter::new('roles'))
			->add(BooleanFilter::new('isVerified'))
        ;
    }
}
