<?php

namespace App\Repository;

use App\Entity\Idea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Idea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Idea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Idea[]    findAll()
 * @method Idea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Idea::class);
    }

    public function findRecentIdeas()
    {
//DB request using Query Builder
        $qb = $this->createQueryBuilder('i');
        $qb->andWhere('i.isPublished = true')->addOrderBy('i.id', 'DESC');
        $qb->setMaxResults(5);
        $query = $qb->getQuery();
        return $query->getResult();

    }

    // //DB request using Doctrine Query Language (dql)
    /*
        $em = $this->getEntityManager();
        $dql = "SELECT i
                FROM App\Entity\Idea i
                WHERE i.id >= 1 ";
        $query = $em->createQuery($dql);
        $query->setMaxResults(5);
        return $query->getResult();
    }
*/
    // /**
    //  * @return Idea[] Returns an array of Idea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Idea
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
