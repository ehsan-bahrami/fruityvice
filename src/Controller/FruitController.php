<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FruitController extends AbstractController
{
    #[Route('/fruit', name: 'app_fruit')]
    public function index(FruitRepository $fruitRepository): Response
    {
        $fruits = $fruitRepository->findAll();

        return $this->render('fruit/index.html.twig', [
            'title' => 'Fruits table',
            'fruits' => $fruitRepository->convertFruitEntitiesToDataTableArray($fruits),
        ]);
    }

    #[Route('/fruit/favorite', name: 'app_fruit_favorite')]
    public function favorite(FruitRepository $fruitRepository): Response
    {
        $fruits = $fruitRepository->findByFavoriteField(true);

        return $this->render('fruit/favorite.html.twig', [
            'title' => 'Favorite fruits table',
            'fruits' => $fruitRepository->convertFruitEntitiesToDataTableArray($fruits),
        ]);
    }

    #[Route('/fruit/toggle-favorite/{id}', name: 'app_fruit_favorite_toggle', requirements: ['id' => '\d+'])]
    public function toggleFavorite(int $id, FruitRepository $fruitRepository): JsonResponse
    {
        $fruit = $fruitRepository->findByFavoriteFieldAndToggle($id);

        return $this->json(['fruit' => $fruit]);
    }
}
