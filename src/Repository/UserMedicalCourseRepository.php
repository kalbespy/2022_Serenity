<?php

namespace App\Repository;

use App\Entity\UserMedicalCourse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserMedicalCourse>
 *
 * @method UserMedicalCourse|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMedicalCourse|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMedicalCourse[]    findAll()
 * @method UserMedicalCourse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMedicalCourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMedicalCourse::class);
    }

    public function save(UserMedicalCourse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserMedicalCourse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMedicalCourseByUser(int $userId): array
    {
        $queryBuilder = $this->createQueryBuilder('u')
            ->join('u.medicalCourse', 'medicalCourse')
            ->select('u', 'medicalCourse')
            ->where('u.user =' . $userId)
            ->getQuery();

        return $queryBuilder->getResult();
    }

//    /**
//     * @return UserMedicalCourse[] Returns an array of UserMedicalCourse objects
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

//    public function findOneBySomeField($value): ?UserMedicalCourse
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
