<?php

namespace App\Repository;

use App\Entity\UserMedDiscipline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserMedDiscipline>
 *
 * @method UserMedDiscipline|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMedDiscipline|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMedDiscipline[]    findAll()
 * @method UserMedDiscipline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMedDisciplineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMedDiscipline::class);
    }

    public function save(UserMedDiscipline $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserMedDiscipline $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMedicalDisciplineByUser(int $userId): array
    {
        $queryBuilder = $this->createQueryBuilder('u')
            ->join('u.medicalDiscipline', 'medicalDiscipline')
            ->select('u', 'medicalDiscipline')
            ->where('u.user =' . $userId)
            ->getQuery();

        return $queryBuilder->getResult();
    }

    //    /**
    //     * @return UserMedDiscipline[] Returns an array of UserMedDiscipline objects
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

    //    public function findOneBySomeField($value): ?UserMedDiscipline
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
