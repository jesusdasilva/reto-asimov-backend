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

    public function findDisabledDays($rYear, $rMonth)
    {
        $sql = '
            SELECT r_day 
            FROM view_disabled_days
            WHERE r_year = :rYear and r_month = :rMonth 
            ';

        return $this->getEntityManager()
            ->getConnection()
            ->prepare($sql)
            ->executeQuery(['rYear' => $rYear, 'rMonth' => $rMonth])
            ->fetchAllAssociative();
    }

    public function findDisabledHours($rYear, $rMonth, $rDay)
    {
        return $this->createQueryBuilder('r')
            ->select('r.rHour')
            ->andWhere('r.rYear = :rYear')
            ->andWhere('r.rMonth = :rMonth')
            ->andWhere('r.rDay = :rDay')
            ->setParameter('rYear', $rYear)
            ->setParameter('rMonth', $rMonth)
            ->setParameter('rDay', $rDay)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findActive($rEmail, $rYear, $rMonth, $rDay){
        
        $sql = '
            SELECT * 
            FROM reservation
            WHERE (r_year||\'-\'||r_month||\'-\'||r_day) >= (:rYear||\'-\'||:rMonth||\'-\'||:rDay) 
                AND r_email = :rEmail
            ';

        return $this->getEntityManager()
            ->getConnection()
            ->prepare($sql)
            ->executeQuery(['rEmail'=>$rEmail, 'rYear' => $rYear, 'rMonth' => $rMonth, 'rDay' => $rDay])
            ->fetchAllAssociative();
    }

    public function findByYMDH($rYear, $rMonth, $rDay, $rHour)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.rYear = :rYear')
            ->andWhere('r.rMonth = :rMonth')
            ->andWhere('r.rDay = :rDay')
            ->andWhere('r.rHour = :rHour')
            ->setParameter('rYear', $rYear)
            ->setParameter('rMonth', $rMonth)
            ->setParameter('rDay', $rDay)
            ->setParameter('rHour', $rHour)
            ->getQuery()
            ->getResult()
        ;
    }

}