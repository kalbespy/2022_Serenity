<?php

namespace App\Repository;

use App\Entity\Welfare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @extends ServiceEntityRepository<Welfare>
 *
 * @method Welfare|null find($id, $lockMode = null, $lockVersion = null)
 * @method Welfare|null findOneBy(array $criteria, array $orderBy = null)
 * @method Welfare[]    findAll()
 * @method Welfare[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WelfareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Welfare::class);
    }

    public function save(Welfare $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Welfare $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findWelfareByUserByDate(int $userId, string $today): array
    {
        $queryBuilder = $this->createQueryBuilder('w')
            ->select('u.id, w.score, w.responseAt')
            ->join('w.user', 'u')
            ->where('w.user = :userId')
            ->andWhere('w.responseAt = :responseAt')
            ->setParameters([
                'userId' => $userId,
                'responseAt' => $today
            ])
            ->getQuery();

        return $queryBuilder->getResult();
    }

    //    /**
    //     * @return Welfare[] Returns an array of Welfare objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('w.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Welfare
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
