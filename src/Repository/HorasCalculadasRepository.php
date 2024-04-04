<?php

namespace App\Repository;

use App\Entity\HorasCalculadas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HorasCalculadas>
 *
 * @method HorasCalculadas|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorasCalculadas|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorasCalculadas[]    findAll()
 * @method HorasCalculadas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorasCalculadasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorasCalculadas::class);
    }

    public function add(HorasCalculadas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HorasCalculadas $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HorasCalculadas[] Returns an array of HorasCalculadas objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HorasCalculadas
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
