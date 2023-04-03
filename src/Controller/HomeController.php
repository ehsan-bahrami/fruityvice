<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home')]
    public function index(FruitRepository $fruitRepository): Response
    {
        $fruits = $fruitRepository->findAll();

        return $this->render('home.html.twig', [
            'fruits' => array_map(fn($value) => [$value->getName(), $value->getFamily(), $value->getCarbohydrates(), $value->getProtein(), $value->getFat(), $value->getCalories(), $value->getSugar(), $value->isFavorite(), ], $fruits ),
        ]);
    }
}