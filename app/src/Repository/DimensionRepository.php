<?php

namespace App\Repository;

use App\Entity\Dimension;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dimension|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dimension|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dimension[]    findAll()
 * @method Dimension[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DimensionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dimension::class);
    }
}