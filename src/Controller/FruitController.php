<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FruitController extends AbstractController
{
    #[Route('/fruit', name: 'app_fruit', methods: ['GET'])]
    public function index(FruitRepository $fruitRepository): Response
    {
        $fruits = $fruitRepository->findAll();

        return $this->render('fruit/index.html.twig', [
            'title' => 'Fruits table',
            'fruits' => $fruitRepository->convertFruitEntitiesToDataTableArray($fruits),
        ]);
    }

    #[Route('/fruit/favorite', name: 'app_fruit_favorite', methods: ['GET'])]
    public function favorite(FruitRepository $fruitRepository): Response
    {
        $fruits = $fruitRepository->findByFavoriteField(true);

        return $this->render('fruit/favorite.html.twig', [
            'title' => 'Favorite fruits table',
            'fruits' => $fruitRepository->convertFruitEntitiesToDataTableArray($fruits),
        ]);
    }

    #[Route('/fruit/toggle-favorite/{name}', name: 'app_fruit_favorite_toggle', requirements: ['name' => '\w+'], methods: ['GET'])]
    public function toggleFavorite(string $name, FruitRepository $fruitRepository): JsonResponse
    {
        $fruit = $fruitRepository->findOneBy(['name' => $name]);

        $favoriteFruits = $fruitRepository->findByFavoriteField(true);

        if (!$fruit->isFavorite() && count($favoriteFruits) > 9) {
            return $this->json(['error' => true], 404);
        }

        $fruit = $fruitRepository->findByFavoriteFieldAndToggle($name);

        return $this->json(['fruit' => $fruit]);
    }
}
