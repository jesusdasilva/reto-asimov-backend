<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Reservation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route('/v1/reservation', name: 'v1_reservation_')]
class ReservationController extends AbstractController
{
    #[Route(path: '/', name: 'find', methods: ['GET'])]
    public function find(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        if(1>= $request->query->count()) {
            $data = $doctrine->getRepository(Reservation::class)->findBy(
                $request->query->all()
            );
        }else{
            $data = $doctrine->getRepository(Reservation::class)->findAll();
        }

        return $this->json(
            $data, 
            Response::HTTP_OK,
            [],
            ['groups' => 'full']
        );
    }
}
