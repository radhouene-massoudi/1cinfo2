<?php

namespace App\Repository;

use App\Entity\Pro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pro>
 *
 * @method Pro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pro[]    findAll()
 * @method Pro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pro::class);
    }

    //    /**
    //     * @return Pro[] Returns an array of Pro objects
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

    //    public function findOneBySomeField($value): ?Pro
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function myFindAll()
    {
        $em = $this->getEntityManager();
        $req = $em->createQuery("select p from App\Entity\Pro p");
        return $req->getResult();
    }
    public function nbProductByCat($categorie)
    {
        $em = $this->getEntityManager();
        $req = $em->createQuery("select count(p) from App\Entity\Pro p join p.cat c where c.name=:y ");
        $req->setParameter('y', $categorie);
        return $req->getSingleScalarResult();
    }

    public function MyFindAllTWo($cat)
    {
        $req = $this->createQueryBuilder('p') //select * from product
            ->select('p.name')
            ->addSelect('p.price')
            ->join('p.cat', 'c');
        if (true) {
            $req->where("c.name=:n")
            ->setParameter('n', $cat);
        }
        $result = $req->getQuery()
            ->getResult();
        return $result;
    }
}
