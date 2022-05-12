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

    public function findDisabledDates($_month)
    {
        $sql = '
            SELECT r_date 
            FROM view_disabled_dates 
            WHERE date_part(\'month\',r_date) = :_month 
            ';

        return $this->getEntityManager()
            ->getConnection()
            ->prepare($sql)
            ->executeQuery(['_month' => $_month])
            ->fetchAllAssociative();
    }

    public function findDisabledHours($_date)
    {
        return $this->createQueryBuilder('r')
            ->select('r.rHour')
            ->andWhere('r.rDate = :rDate')
            ->setParameter('rDate', $_date)
            ->getQuery()
            ->getResult()
        ;
    }
}