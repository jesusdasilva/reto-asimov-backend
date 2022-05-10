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

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/available-dates', name: 'find_available_dates', methods: ['GET'])]
    public function findAvailableDates(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = $doctrine->getRepository(Reservation::class)->findAvailableDates(
            $request->query->get('_month')
        );

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/active', name: 'find_active', methods: ['GET'])]
    public function findActive(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = $doctrine->getRepository(Reservation::class)->findActive(
            $request->query->get('rEmail'),
            $request->query->get('rDate')
        );

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/available', name: 'find_available', methods: ['GET'])]
    public function findAvailable(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = $doctrine->getRepository(Reservation::class)->findAvailable(
            $request->query->get('rDate'),
            $request->query->get('rHour')
        );

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/', name: 'create', methods: ['POST'])]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $values = json_decode($request->getContent(), true);

        $reservation = new Reservation();
        $reservation->setRFirstName($values['rFirstName']);
        $reservation->setRLastName($values['rLastName'] ?? null);
        $reservation->setRPhone($values['rPhone'] ?? null);
        $reservation->setREmail($values['rEmail']);
        $reservation->setRDate(new \DateTime($values['rDate']));
        $reservation->setRHour($values['rHour']);

        $doctrine->getManager()->persist($reservation);
        $doctrine->getManager()->flush();

        $data = $reservation;
        $status = Response::HTTP_CREATED;

        return $this->json($data, $status, [], ['groups' => 'full']);
    }
}
