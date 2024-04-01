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

class AjusteColabController extends AbstractController
{
    /**
     * @Route("/api/user/{userId}/datetime/edit", name="api_user_datetime_edit", methods={"GET"})
     */
    public function getEditUserDateTime($userId, UserRepository $userRepository, UserDateTimeRepository $userDateTimeRepository): Response
    {
        $user = $userRepository->find($userId);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $currentDate = new \DateTime();
        $fiveDaysAgo = new \DateTime();
        $fiveDaysAgo->modify('-4 days');

        $userDateTimes = $userDateTimeRepository->findRecentUserDateTimes($user, $fiveDaysAgo, $currentDate);

        $serializedUserDateTimes = [];

        foreach ($userDateTimes as $userDateTime) {
            $serializedUserDateTimes[] = [
                'id' => $userDateTime->getId(),
                'date' => $userDateTime->getDate()->format('Y-m-d'),
                'time' => $userDateTime->getTime()->format('H:i:s'),
                'hor_trab' => $user->getHorTrab(),
            ];
        }

        return new JsonResponse($serializedUserDateTimes);
    }
    /**
     * @Route("/api/user/{userId}/modify", name="api_user_datetime_modify", methods={"POST"})
     */
    public function modify(Request $request, $userId): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $userDateTime = new UserDateTime();
        $userDateTime->setDate(new \DateTime($data['date']));
        $userDateTime->setTime(new \DateTime($data['time']));
        $userDateTime->setInsert('Insert');
        $userDateTime->setUser($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userDateTime);
        $entityManager->flush();

        $dateTime = $userDateTime->getDate()->format('Y-m-d') . ' ' . $userDateTime->getTime()->format('H:i:s');

        return new JsonResponse(['message' => 'Hora Atualizada com sucesso'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/api/user/{userId}/modify/update", name="api_user_datetime_modify_update", methods={"POST"})
     */
    public function update(Request $request, $userId): Response
    {
        $data = json_decode($request->getContent(), true);

        $userDateTimeId = $data['id'];

        $entityManager = $this->getDoctrine()->getManager();

        $userDateTime = $entityManager->getRepository(UserDateTime::class)->find($userDateTimeId);

        if (!$userDateTime) {
            return new JsonResponse(['error' => 'UserDateTime not found'], Response::HTTP_NOT_FOUND);
        }

        $userDateTime->setUpdate('Update');
        $userDateTime->setHoraeditada($data['time']);

        $entityManager->flush();

        return new JsonResponse(['message' => 'Hora Atualizada com sucesso'], Response::HTTP_CREATED);
    }
}