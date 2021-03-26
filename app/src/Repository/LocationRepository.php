<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function save(Location $character): ?Location
    {
        $this->_em->persist($character);
        $this->_em->flush();

        return $character;
    }

    /**
     * @param int $externalId
     * @return Location Returns an array of Location objects
     * @throws NonUniqueResultException
     */
    public function findOneByExternalId(int $externalId): ?Location
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.externalId = :externalId')
            ->setParameter('externalId', $externalId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
