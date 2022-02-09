<?php

namespace App\Repository;

use App\Entity\Plat;
use App\DTO\SearchDishCriteria;
use App\Form\SearchDishType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Plat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plat[]    findAll()
 * @method Plat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plat::class);
    }


    //recupere les infos du formulaire de recherche
    public function findAllByCriteria(SearchDishCriteria $DTO): array
    {
        $qb = $this->createQueryBuilder('dish');

        if($DTO->title) {
            $qb
            ->andWhere('dish.name LIKE :title')
            ->setParameter('title', '%' . $DTO->title . '%');
        }

        return $qb
            ->setMaxResults($DTO->limit)
            ->setFirstResult($DTO->limit * ($DTO->page) -1)
            ->getQuery()
            ->getResult();
    }


    //recuperer touts les plats ordonné par prix croissants
    public function findAllByPriceAscOrder(): array
    {
        return $this->createQueryBuilder('dish')
                    ->orderBy('dish.price', 'ASC')
                    ->getQuery()
                    ->getResult();
    }

    //recuperer tous les plats dont le nom commence par Pizza
    public function findAllLikePizza(): array
    {
        return $this->createQueryBuilder('dish')
                    ->andWhere('dish.name LIKE :like')
                    ->setParameter('like', 'Pizza%')
                    ->getQuery()
                    ->getResult();
    }

    //Récupérer uniquement 5 plats ordonée par nom croissant
    public function findFiveOrderedByName(): array
    {
        return $this->createQueryBuilder('dish')
                    ->orderBy('dish.name', 'ASC')
                    ->setMaxResults(5)
                    ->getQuery()
                    ->getResult();
    }

    //Récupérer les 10 plats à partir de la page n°2, ordonée par prix decroissant
    public function findTenOfPageTwoOrderedByPrice(): array
    {
        return $this->createQueryBuilder('dish')
                    ->orderBy('dish.price', 'DESC')
                    ->setFirstResult(10)
                    ->setMaxResults(10)
                    ->getQuery()
                    ->getResult();
    }

    //Récupérer les 15 plats avec l'ingrédient "Tomate"
    public function findDishWithTomato()
    {
        return $this->createQueryBuilder('dish')
                    ->leftJoin('dish.ingredients', 'ingredient')
                    ->andWhere('ingredient.name = :ingrdientName')
                    ->setParameter('ingredientName', 'tomate')
                    ->setMaxResults(15)
                    ->getQuery()
                    ->getResult();
    }

    // /**
    //  * @return Plat[] Returns an array of Plat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Plat
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
