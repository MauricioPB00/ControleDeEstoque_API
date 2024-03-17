<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserDateTimeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AprovarController extends AbstractController
{
    /**
     * @Route("/api/user/approve/time", name="api_user_approve_time", methods={"GET"})
     */
    public function getRecentUserDateTime(UserDateTimeRepository $userDateTimeRepository): JsonResponse
    {
        // get all 
        $userDateTimes = $userDateTimeRepository->findRecentUserDateTimesWithEditadoNotNull();

        $serializedUserDateTimes = [];

        foreach ($userDateTimes as $userDateTime) {
            $serializedUserDateTimes[] = [
                'id' => $userDateTime->getId(),
                'date' => $userDateTime->getDate()->format('Y-m-d'),
                'time' => $userDateTime->getTime()->format('H:i:s'),
                'update' => $userDateTime->getUpdate(),
                'insert' => $userDateTime->getInsert(),
                'horaeditada' => $userDateTime->getHoraeditada(),
                'user_id' => $userDateTime->getUser()->getId(),
            ];
        }

        return new JsonResponse($serializedUserDateTimes);
    }


    /**
     * @Route("/api/user/approve/patch", name="api_user_approve_patch",  methods={"PATCH"})
     */
    public function patchUserDateTime(Request $request, UserDateTimeRepository $userDateTimeRepository): Response
    {
        // patch para time === horaedata 
        $data = json_decode($request->getContent(), true);
        if (!isset($data['ids']) || !is_array($data['ids'])) {
            return new JsonResponse(['error' => 'IDs não fornecidos'], Response::HTTP_BAD_REQUEST);
        }
        $ids = $data['ids'];

        try {
            $registros = $userDateTimeRepository->findBy(['id' => $ids]);
            foreach ($registros as $registro) {
                $registro->setUpdate(null);
                $registro->setHoraeditada(null);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return new JsonResponse(['message' => 'Registros atualizados com sucesso'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erro ao atualizar registros: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
