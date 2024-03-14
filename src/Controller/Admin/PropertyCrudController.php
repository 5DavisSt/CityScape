<?php

namespace App\Controller\Admin;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use App\Entity\Property;
use App\Entity\Picture;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }

	public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Propriétés')
            ->setEntityLabelInSingular('une propriété')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('propHousingType', 'Type de propriété')->setChoices([
				'Maison' => 'house',
				'Pavillon' => 'single_family',
				'Appartement' => 'apartment',
				'Bureau' => 'office',
				'Villa' => 'villa',
				'Luxe' => 'luxury_home',
				'Studio' => 'studio'
			]),
            IntegerField::new('propNbRooms', 'Nb de chambres'),
			IntegerField::new('propSQM', 'Nb de m²'),
			MoneyField::new('propPrice', 'Prix')->setCurrency('EUR'),
			IntegerField::new('propNbBeds', 'Nb de lits'),
			IntegerField::new('propNbBaths', 'Nb de baignoires'),
			IntegerField::new('propNbSpaces', 'Nb de places de parking'),
			BooleanField::new('propFurnished', 'Meublé ?'),
			ArrayField::new('propFeature', 'Feature(s)'),
			CollectionField::new('propPicture', 'Image(s)')
				->setTemplatePath('bundles/EasyAdminBundle/page/picture.html.twig')
                ->useEntryCrudForm()
			];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(ChoiceFilter::new('propHousingType')->setChoices([
				'Maison' => 'house',
				'Pavillon' => 'single_family',
				'Appartement' => 'apartment',
				'Bureau' => 'office',
				'Villa' => 'villa',
				'Luxe' => 'luxury_home',
				'Studio' => 'studio'
			]))
			->add(NumericFilter::new('propNbRooms', 'Nombre de chambres'))
			->add(NumericFilter::new('propPrice'))
			->add(NumericFilter::new('propSQM', 'Nombre de mètres carrés'))
			->add(NumericFilter::new('propNbBeds', 'Nombre de lits'))
			->add(NumericFilter::new('propNbBaths', 'Nombre de baignoires'))
			->add(NumericFilter::new('propNbSpaces', 'Nombre de places de parking'))
			->add(BooleanFilter::new('propFurnished', 'Meublé ou non ?'))
			->add(ArrayFilter::new('propFeature', 'Features associées (?)'))
        ;
    }
	
	public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
