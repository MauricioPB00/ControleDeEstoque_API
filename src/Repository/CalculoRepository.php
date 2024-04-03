<?php

namespace App\Repository;

use App\Entity\Calculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Calculo>
 *
 * @method Calculo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calculo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calculo[]    findAll()
 * @method Calculo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calculo::class);
    }

    public function add(Calculo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Calculo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function findByMonth($primeiroDiaMesAtual, $ultimoDiaMesAtual)
    {
        return $this->createQueryBuilder('udt')
            ->andWhere('udt.date BETWEEN :primeiroDiaMesAtual AND :ultimoDiaMesAtual')
            ->setParameter('primeiroDiaMesAtual', $primeiroDiaMesAtual)
            ->setParameter('ultimoDiaMesAtual', $ultimoDiaMesAtual)
            ->orderBy('udt.id', 'DESC')
            ->addOrderBy('udt.date', 'DESC')
            ->addOrderBy('udt.time', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Calculo[] Returns an array of Calculo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Calculo
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
