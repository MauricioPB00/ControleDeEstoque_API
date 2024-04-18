<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\HorasCalculadas;
use App\Repository\CalculoRepository;


class EmpresaController extends AbstractController
{
    /**
     * @Route("/user/empresa/horasCalculadas", name="api_user_empresa_horasCalculadas", methods={"GET"})
     */
    public function buscarHorasCalculadas(): JsonResponse
    {
        $repository = $this->getDoctrine()->getRepository(HorasCalculadas::class);
        $horasCalculadas = $repository->findAll();

        $horasCalculadasArray = [];
        foreach ($horasCalculadas as $horasCalculada) {
            $horasCalculadasArray[] = [
                'user' => $horasCalculada->getUser()->getId(),
                'mes' => $horasCalculada->getMes(),
                'ano' => $horasCalculada->getAno(),
                'diasFaltados' => $horasCalculada->getDiasFaltados(),
                'diasTrabalhados' => $horasCalculada->getDiasTrabalhados(),
                'diasUteis' => $horasCalculada->getDiasUteis(),
                'horasFaltando' => $horasCalculada->getHorasFaltando(),
                'horasNoMesTrabalhadas' => $horasCalculada->getHorasNoMesTrabalhadas(),
                'totalHorasDiasSemana' => $horasCalculada->getTotalHorasDiasSemana(),
                'totalHorasDomingo' => $horasCalculada->getTotalHorasDomingo(),
                'totalHorasSabado' => $horasCalculada->getTotalHorasSabado(),
                'progressBar' => $horasCalculada->getProgresso(),
            ];
        }
        return new JsonResponse($horasCalculadasArray);
    }
}
