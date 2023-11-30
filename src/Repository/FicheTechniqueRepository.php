<?php

namespace App\Repository;

use App\Entity\FicheTechnique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheTechnique>
 *
 * @method FicheTechnique|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheTechnique|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheTechnique[]    findAll()
 * @method FicheTechnique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheTechniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheTechnique::class);
    }

//    /**
//     * @return FicheTechnique[] Returns an array of FicheTechnique objects
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

//    public function findOneBySomeField($value): ?FicheTechnique
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
