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

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;

use GuzzleHttp\Client;
use Geocoder\Provider\Photon\Photon;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;

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
			->setFormThemes(['back/dashboard/geocoder.html.twig', '@EasyAdmin/crud/form_theme.html.twig'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
		// $config = [
			// 'timeout' => 2.0,
			// 'verify' => false,
		// ];
		// $url = 'https://photon.komoot.io/api/?q=berlin';
		
		// $client = new Client($config);
		// $geocoder = new Photon($client, $url);

		// $result = $geocoder->geocodeQuery(GeocodeQuery::create('Berlin'));
		
		// $result = $geocoder->geocodeQuery(GeocodeQuery::create('Buckingham Palace, London'));
		// $result = $geocoder->reverseQuery(ReverseQuery::fromCoordinates(...));	

        return [
			TextField::new('geocoder', 'Entrez le nom de la ville où se trouve la propriété')
				->onlyOnForms()
				->setFormTypeOptions([
				'block_name' => 'custom_title',
				]),
			NumberField::new('propLatitude', 'Latitude de la propriété')->hideOnIndex(),
			NumberField::new('propLongitude', 'Longitude de la propriété')->hideOnIndex(),
			TextField::new('propTitle', 'Titre'),
            ChoiceField::new('propHousingType', 'Type de propriété')->setChoices([
				'Maison' => 'house',
				'Pavillon' => 'single_family',
				'Appartement' => 'apartment',
				'Bureau' => 'office',
				'Villa' => 'villa',
				'Luxe' => 'luxury_home',
				'Studio' => 'studio'
			]),
            IntegerField::new('propNbRooms', 'Chambre(s)'),
			IntegerField::new('propSQM', 'm²'),
			MoneyField::new('propPrice', 'Prix')->setCurrency('EUR'),
			IntegerField::new('propNbBeds', 'Lit(s)'),
			IntegerField::new('propNbBaths', 'Baignoire(s)'),
			IntegerField::new('propNbSpaces', 'Place(s) de parking'),
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
			->add(TextFilter::new('propTitle', 'Titre de l\'annonce'))
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
