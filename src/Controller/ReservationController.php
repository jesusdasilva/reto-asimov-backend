<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Reservation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/v1/reservation', name: 'v1_reservation_')]
class ReservationController extends AbstractController
{
    #[Route(path: '/', name: 'find', methods: ['GET'])]
    public function find(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        // if(1>= $request->query->count()) {
        //     $data = $doctrine->getRepository(Reservation::class)->findBy(
        //         $request->query->all()
        //     );
        // }else{
            $data = $doctrine->getRepository(Reservation::class)->findAll();
        // }

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/disabled-days', name: 'find_disabled_days', methods: ['GET'])]
    public function findDisabledDates(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = $doctrine->getRepository(Reservation::class)->findDisabledDays(
            $request->query->get('rYear'),
            $request->query->get('rMonth')
        );

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/disabled-hours', name: 'find_disabled_hours', methods: ['GET'])]
    public function findDisabledHours(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = $doctrine->getRepository(Reservation::class)->findDisabledHours(
            $request->query->get('rYear'),
            $request->query->get('rMonth'),
            $request->query->get('rDay')
        );

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/active', name: 'find_active', methods: ['GET'])]
    public function findActive(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = $doctrine->getRepository(Reservation::class)->findActive(
            $request->query->get('rEmail'),
            $request->query->get('rYear'),
            $request->query->get('rMonth'),
            $request->query->get('rDay')
        );

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/available-hour', name: 'find_available_hour', methods: ['GET'])]
    public function findAvailableHour(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $data = $doctrine->getRepository(Reservation::class)->findByYMDH(
            $request->query->get('rYear'),
            $request->query->get('rMonth'),
            $request->query->get('rDay'),
            $request->query->get('rHour')
        );

        return $this->json($data, Response::HTTP_OK, [], ['groups' => 'full']);
    }

    #[Route(path: '/', name: 'create', methods: ['POST'])]
    public function create(ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator): JsonResponse
    {
        $values = json_decode($request->getContent(), true);

        $reservation = new Reservation();
        $reservation->setRFirstName($values['rFirstName'] ?? '');
        $reservation->setRLastName($values['rLastName'] ?? '');
        $reservation->setRPhone($values['rPhone'] ?? '');
        $reservation->setREmail($values['rEmail'] ?? '');
        $reservation->setRHour($values['rHour'] ?? '');
        $reservation->setRDay($values['rDay'] ?? '');
        $reservation->setRMonth($values['rMonth'] ?? '');
        $reservation->setRYear($values['rYear'] ?? '');

        $errors = $validator->validate($reservation);

        if(count($errors) > 0) {
            
            return $this->json(str_replace("\n", "", (string) $errors), Response::HTTP_BAD_REQUEST);
        }else{
            $doctrine->getManager()->persist($reservation);
            $doctrine->getManager()->flush();

            return $this->json($reservation, Response::HTTP_CREATED, [], ['groups' => 'full']);
        }
    }
}
