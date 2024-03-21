<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserDateTimeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

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
                'file'=> $userDateTime->getUser()->getFile(),
                'name'=> $userDateTime->getUser()->getName(),
                'username'=> $userDateTime->getUser()->getUsername(),
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

    /**
     * @Route("/api/user/approve/patch/update", name="api_user_approve_patch_update",  methods={"PATCH"})
     */
    public function approve(Request $request, UserDateTimeRepository $userDateTimeRepository): Response
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['ids']) || !is_array($data['ids'])) {
            return new JsonResponse(['error' => 'IDs não fornecidos'], Response::HTTP_BAD_REQUEST);
        }
        $ids = $data['ids'];

        try {
            $registros = $userDateTimeRepository->findBy(['id' => $ids]);
            foreach ($registros as $registro) {
                $horaeditada = new \DateTime($registro->getHoraeditada());
                $registro->setTime($horaeditada);
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

    /**
     * @Route("/api/user/approve/patch/insert", name="api_user_approve_patch_insert",  methods={"PATCH"})
     */
    public function approveInsert(Request $request, UserDateTimeRepository $userDateTimeRepository): Response
    {
        $data = json_decode($request->getContent(), true);
        if (!isset($data['ids']) || !is_array($data['ids'])) {
            return new JsonResponse(['error' => 'IDs não fornecidos'], Response::HTTP_BAD_REQUEST);
        }
        $ids = $data['ids'];

        try {
            $registros = $userDateTimeRepository->findBy(['id' => $ids]);
            foreach ($registros as $registro) {
                $registro->setInsert(null);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return new JsonResponse(['message' => 'Registros atualizados com sucesso'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erro ao atualizar registros: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/api/user/approve/delete/insert", name="api_user_approve_delete_insert", methods={"POST"})
     */
    public function deleteInsertNoApprove(Request $request, UserDateTimeRepository $userDateTimeRepository, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['ids']) || !is_array($data['ids'])) {
            return new JsonResponse(['error' => 'IDs não fornecidos'], Response::HTTP_BAD_REQUEST);
        }

        $ids = $data['ids'];

        try {
            $registros = $userDateTimeRepository->findBy(['id' => $ids]);
            foreach ($registros as $registro) {
                $entityManager->remove($registro);
            }
            $entityManager->flush();

            return new JsonResponse(['message' => 'Registros não aprovados removidos com sucesso'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Erro ao remover registros não aprovados: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
