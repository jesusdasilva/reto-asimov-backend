<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function findActive($rEmail, $rDate){
        return $this->createQueryBuilder('r')
            ->andWhere('r.rEmail = :rEmail')
            ->andWhere('r.rDate >= :rDate')
            ->setParameter('rEmail', $rEmail)
            ->setParameter('rDate', $rDate)
            ->getQuery()
            ->getResult()
        ;


    }

    public function findAvailable($rDate, $rHour){
        return $this->createQueryBuilder('r')
            ->andWhere('r.rDate = :rDate')
            ->andWhere('r.rHour = :rHour')
            ->setParameter('rDate', $rDate)
            ->setParameter('rHour', $rHour)
            ->getQuery()
            ->getResult()
        ;


    }

}