<?php

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fruit>
 *
 * @method Fruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fruit[]    findAll()
 * @method Fruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    public function save(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Fruit[] Returns an array of Fruit objects
     */
    public function findByFavoriteField(bool $value): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.favorite = :favorite')
            ->setParameter('favorite', $value)
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array Returns an array of Fruit array
     */
    public function convertFruitEntitiesToDataTableArray(array $fruits): array
    {
        return array_map(
            fn ($value) => [
                $value->getName(),
                $value->getFamily(),
                $value->getCarbohydrates(),
                $value->getProtein(),
                $value->getFat(),
                $value->getCalories(),
                $value->getSugar(),
                $value->isFavorite(),
            ],
            $fruits
        );
    }

    /**
     * @return Fruit|null Returns an Fruit object
     */
    public function findByFavoriteFieldAndToggle(int $id): ?Fruit
    {
        $fruit = $this->find($id);
        $fruit->setFavorite(!$fruit->isFavorite());
        $this->save($fruit, true);

        return $fruit;
    }

    //    /**
    //     * @return Fruit[] Returns an array of Fruit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Fruit
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
