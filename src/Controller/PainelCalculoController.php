<?php

namespace App\Controller;

use App\Entity\UserDateTime;
use App\Entity\Calculo;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserDateTimeRepository;
use App\Repository\CalculoRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Criteria;


class PainelCalculoController extends AbstractController
{
    /**
     * @Route("/user/painel/buscahoras", name="api_user_user_painel_buscahoras",  methods={"GET"})
     */
    public function buscaHoras(UserDateTimeRepository $userDateTimeRepository): JsonResponse
    {
        $primeiroDiaMesAtual = new \DateTime('first day of this month');

        $ultimoDiaMesAtual = new \DateTime('last day of this month');

        $userDateTimes = $userDateTimeRepository->findByMonth($primeiroDiaMesAtual, $ultimoDiaMesAtual);

        usort($userDateTimes, function ($a, $b) {
            return $a->getUser()->getId() - $b->getUser()->getId();
        });

        $formattedUserDateTimes = [];
        foreach ($userDateTimes as $userDateTime) {
            $formattedUserDateTimes[] = [
                'id' => $userDateTime->getId(),
                'date' => $userDateTime->getDate()->format('Y-m-d'),
                'time' => $userDateTime->getTime()->format('H:i:s'),
                'user_id' => $userDateTime->getUser()->getId(),
            ];
        }

        return new JsonResponse($formattedUserDateTimes);
    }
}
