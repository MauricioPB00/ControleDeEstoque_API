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
use App\Repository\UserDateTimeRepository;
use App\Repository\UserRepository;


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

    /**
     * @Route("/user/empresa/{userId}/usuario", name="api_user_empresa_buscarDadosUsuario", methods={"GET"})
     */
    public function buscarDadosUsuario($userId, UserRepository $userRepository, UserDateTimeRepository $userDateTimeRepository): Response
    {
        $user = $userRepository->find($userId);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $userData = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'nome' => $user->getName(),
            'cpf' => $user->getCpf(),
            'rg' => $user->getRg(),
            'cidade' => $user->getCidade(),
            'job' => $user->getJob(),
            'horTrab' =>$user->getHorTrab()
        ];

        return new JsonResponse($userData, Response::HTTP_OK);
    }
}