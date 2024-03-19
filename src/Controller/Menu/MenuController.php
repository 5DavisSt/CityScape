<?php

namespace App\Controller\Menu;

use App\Repository\CategoryRepository;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{
	public function menu(CategoryRepository $category, PropertyRepository $property): Response
	{
		return $this->render('_partials/_menu.html.twig', [
			'categories' => $category->findBy(['parent' => null]),
		]);
	}
}