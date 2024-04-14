<?php

namespace App\Repository;

use App\Entity\ProfessionelSante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfessionelSante>
 *
 * @method ProfessionelSante|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfessionelSante|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfessionelSante[]    findAll()
 * @method ProfessionelSante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionelSanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfessionelSante::class);
    }

    //    /**
    //     * @return ProfessionelSante[] Returns an array of ProfessionelSante objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProfessionelSante
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
