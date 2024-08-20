<?php

namespace App\Controller;

use App\Entity\UserDateTime;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserDateTimeRepository;
use App\Repository\UserRepository;

class UserDateTimeController extends AbstractController
{
    /**
     * @Route("/api/user/{userId}/datetime", name="api_user_datetime_create", methods={"POST"})
     */
    public function create(Request $request, $userId): Response
    {
        // registrar ponto
        // $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        // if (!$user) {
        //     return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        // }

        // $data = json_decode($request->getContent(), true);

        // $userDateTime = new UserDateTime();
        // $userDateTime->setDate(new \DateTime($data['date']));
        // $userDateTime->setTime(new \DateTime($data['time']));
        // $userDateTime->setUser($user);

        // $entityManager = $this->getDoctrine()->getManager();
        // $entityManager->persist($userDateTime);
        // $entityManager->flush();

        // $dateTime = $userDateTime->getDate()->format('Y-m-d') . ' ' . $userDateTime->getTime()->format('H:i:s');

        // return new JsonResponse(['message' => 'Hora Registrada com sucesso', 'dateTime' => $dateTime], Response::HTTP_CREATED);

        // para receber um array 
        // registrar pontos []

        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        foreach ($data as $dateTimeData) {
            $userDateTime = new UserDateTime();
            $userDateTime->setDate(new \DateTime($dateTimeData['date']));
            $userDateTime->setTime(new \DateTime($dateTimeData['time']));
            $userDateTime->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userDateTime);
        }

        $entityManager->flush();

        return new JsonResponse(['message' => 'Horas Registradas com sucesso'], Response::HTTP_CREATED);
    
    }

    /**
     * @Route("/api/user/{userId}/datetime/recent", name="api_user_datetime_recent", methods={"GET"})
     */
    public function getRecentUserDateTime($userId, UserRepository $userRepository, UserDateTimeRepository $userDateTimeRepository): Response
    {
        // no ponto, busca os ultimos pontos feito
        $user = $userRepository->find($userId);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $currentDate = new \DateTime();
        $fiveDaysAgo = new \DateTime();
        $fiveDaysAgo->modify('-1 days');

        $userDateTimes = $userDateTimeRepository->findRecentUserDateTimes($user, $fiveDaysAgo, $currentDate);

        $serializedUserDateTimes = [];

        foreach ($userDateTimes as $userDateTime) {
            $serializedUserDateTimes[] = [
                'id' => $userDateTime->getId(),
                'date' => $userDateTime->getDate()->format('Y-m-d'),
                'time' => $userDateTime->getTime()->format('H:i:s')
            ];
        }

        return new JsonResponse($serializedUserDateTimes);
    }
}
