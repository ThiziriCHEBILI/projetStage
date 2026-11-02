<?php

namespace App\Repository;

use App\Entity\Show;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Show>
 */
class ShowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Show::class);
    }

    public function searchByTitle(string $search): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.title LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('s.title', 'ASC')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }
}
