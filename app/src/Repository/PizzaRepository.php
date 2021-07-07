<?php

namespace App\Repository;

use App\Entity\Pizza\Pizza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;


class PizzaRepository
{
    private $em;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Pizza::class);
    }

    public function add(Pizza $pizza): void
    {
        $this->em->persist($pizza);
    }

    public function remove(Pizza $pizza): void
    {
        $this->em->remove($pizza);
    }

    public function get($id): Pizza
    {
        /** @var Pizza $pizza */
        if (!$pizza = $this->repo->find($id)) {
            throw new EntityNotFoundException('Pizza is not found.');
        }
        return $pizza;
    }

    public function getByName(string $name): Pizza
    {
        /** @var Pizza $pizza */
        if (!$pizza = $this->repo->findOneBy(['name' => $name])) {
            throw new EntityNotFoundException('Pizza is not found.');
        }

        return $pizza;
    }

    public function hasByName(string $name): bool
    {
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.name = :name')
                ->setParameter(':name', $name)
                ->getQuery()->getSingleScalarResult() > 0;
    }

    // /**
    //  * @return Pizza[] Returns an array of Pizza objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pizza
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
