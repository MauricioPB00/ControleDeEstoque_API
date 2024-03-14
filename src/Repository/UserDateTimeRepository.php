<?php

namespace App\Repository;

use App\Entity\UserDateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

/**
 * @extends ServiceEntityRepository<UserDateTime>
 *
 * @method UserDateTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserDateTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserDateTime[]    findAll()
 * @method UserDateTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserDateTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDateTime::class);
    }

    public function add(UserDateTime $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserDateTime $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findRecentUserDateTimes(User $user, \DateTime $startDate, \DateTime $endDate)
    {
        return $this->createQueryBuilder('ud')
            ->where('ud.user = :user')
            ->andWhere('ud.date BETWEEN :startDate AND :endDate')
            ->setParameter('user', $user)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getResult();
    }
    public function findRecentUserDateTimesWithEditadoNotNull(){
    return $this->createQueryBuilder('ud')
        ->where('ud.editado IS NOT NULL')
        ->getQuery()
        ->getResult();
}

    //    /**
    //     * @return UserDateTime[] Returns an array of UserDateTime objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserDateTime
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
