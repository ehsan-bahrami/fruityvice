<?php

namespace App\Service;

use App\Repository\FruitRepository;

class FruitService
{
    public function __construct(
        private FruitRepository $fruitRepository,
    ) {
    }

    public function getTotalFavoriteFruits(): int
    {
        return count($this->fruitRepository->findByFavoriteField(true));
    }

    public function canAddToFavoriteFruits(string $name): bool
    {
        $fruit = $this->fruitRepository->findOneBy(['name' => $name]);

        if (!$fruit->isFavorite() && $this->getTotalFavoriteFruits() > 9) {
            return false;
        }

        return true;
    }
}
