<?php

namespace App\Repository;

use App\Entity\UserVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserVideo>
 *
 * @method UserVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserVideo[]    findAll()
 * @method UserVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserVideo::class);
    }

    public function save(UserVideo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserVideo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findVideoByUser(int $userId): array
    {
        $queryBuilder = $this->createQueryBuilder('u')
            ->join('u.video', 'video')
            ->select('u', 'video')
            ->where('u.user =' . $userId)
            ->getQuery();

        return $queryBuilder->getResult();
    }

//    /**
//     * @return UserVideo[] Returns an array of UserVideo objects
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

//    public function findOneBySomeField($value): ?UserVideo
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
