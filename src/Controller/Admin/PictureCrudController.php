<?php

namespace App\Controller\Admin;

use App\Entity\Picture;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PictureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Picture::class;
    }

	public function configureFields(string $pageName): iterable
	{
		return [
			TextField::new('picFile', 'Fichier de l\'image')
				->setFormType(VichImageType::class),
			ImageField::new('picName', 'Image')
				->setBasePath('/assets/images/properties')
				->onlyOnIndex(),
			TextField::new('picSize', 'Taille de l\'image')
		];
	}
}
