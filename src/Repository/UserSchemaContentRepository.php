<?php

namespace App\Repository;

use App\Entity\UserSchemaContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserSchemaContent>
 *
 * @method UserSchemaContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSchemaContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSchemaContent[]    findAll()
 * @method UserSchemaContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSchemaContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSchemaContent::class);
    }

    public function save(UserSchemaContent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserSchemaContent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findSchemaByUser(int $userId): array
    {
        $queryBuilder = $this->createQueryBuilder('u')
            ->join('u.schemaContent', 'schemaContent')
            ->select('u', 'schemaContent')
            ->where('u.user =' . $userId)
            ->getQuery();

        return $queryBuilder->getResult();
    }

//    /**
//     * @return UserSchemaContent[] Returns an array of UserSchemaContent objects
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

//    public function findOneBySomeField($value): ?UserSchemaContent
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
