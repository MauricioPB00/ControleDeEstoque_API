<?php

namespace App\Controller;

use App\Entity\UserDateTime;
use App\Entity\Calculo;
use App\Entity\HorasCalculadas;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserDateTimeRepository;
use App\Repository\CalculoRepository;
use App\Repository\HorasCalculadasRepository;
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

    /**
     * @Route("/api/user/painel/salvarhoras", name="api_user_painel_salvarhora", methods={"POST"})
     */
    public function salvarCalculo(Request $request): JsonResponse
    {
        $dados = json_decode($request->getContent(), true);

        if (!isset($dados['date'], $dados['usuario'], $dados['hora'])) {
            return new JsonResponse(['erro' => 'Campos inválidos'], Response::HTTP_BAD_REQUEST);
        }

        $entityManager = $this->getDoctrine()->getManager();

        $existeRegistro = $this->getDoctrine()
            ->getRepository(Calculo::class)
            ->findOneBy([
                'date' => new \DateTime($dados['date']),
                'user' => $dados['usuario']
            ]);

        if ($existeRegistro) {
            $existeRegistro->setTime(new \DateTime($dados['hora']));
            $entityManager->flush();

            return new JsonResponse(['mensagem' => 'Cálculo atualizado com sucesso'], Response::HTTP_OK);
        }

        $calculo = new Calculo();
        $calculo->setDate(new \DateTime($dados['date']));
        $calculo->setTime(new \DateTime($dados['hora']));
        $calculo->setWeekend($dados['weekend']);

        $usuario = $this->getDoctrine()->getRepository(User::class)->find($dados['usuario']);
        if (!$usuario) {
            return new JsonResponse(['erro' => 'Usuário não encontrado'], Response::HTTP_NOT_FOUND);
        }
        $calculo->setUser($usuario);

        $entityManager->persist($calculo);
        $entityManager->flush();

        return new JsonResponse(['mensagem' => 'Cálculo salvo com sucesso'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/user/painel/buscahorasCalculadas", name="api_user_user_painel_buscahorasCalculadas",  methods={"GET"})
     */
    public function buscaHorasCalculadas(CalculoRepository $calculoRepository): JsonResponse
    {
        $primeiroDiaMesAtual = new \DateTime('first day of this month');

        $ultimoDiaMesAtual = new \DateTime('last day of this month');

        $calculo = $calculoRepository->findByMonth($primeiroDiaMesAtual, $ultimoDiaMesAtual);

        usort($calculo, function ($a, $b) {
            return $a->getUser()->getId() - $b->getUser()->getId();
        });

        $formattedcalculo = [];
        foreach ($calculo as $calculo) {
            $formattedcalculo[] = [
                'date' => $calculo->getDate()->format('Y-m-d'),
                'time' => $calculo->getTime()->format('H:i:s'),
                'weekend' => $calculo->getWeekend(),
                'user_id' => $calculo->getUser()->getId(),
                'horTrab' => $calculo->getUser()->getHorTrab()
            ];
        }

        return new JsonResponse($formattedcalculo);
    }

    /**
     * @Route("/api/user/painel/salvarHoraMesTrabalhado", name="api_user_painel_salvarHoraMesTrabalhado", methods={"POST"})
     */
    public function salvarHoraMesTrabalhado(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        
        foreach ($data as $userData) {
            if (!isset($userData['user'])) {
                continue;
            }

            $userId = $userData['user'];
            $user = $entityManager->getRepository(User::class)->find($userId);

            if (!$user) {
                continue;
            }

            $existingRecord = $entityManager->getRepository(HorasCalculadas::class)
                ->findOneBy([
                    'user' => $user,
                    'mes' => $userData['mes'],
                    'ano' => $userData['ano']
                ]);

            if ($existingRecord) {
                $horasCalculadas = $existingRecord;
            } else {
                $horasCalculadas = new HorasCalculadas();
                $horasCalculadas->setUser($user);
            }

            $horasCalculadas->setAno($userData['ano']);
            $horasCalculadas->setDiasFaltados($userData['diasFaltados']);
            $horasCalculadas->setDiasTrabalhados($userData['diasTrabalhados']);
            $horasCalculadas->setDiasUteis($userData['diasUteis']);
            $horasCalculadas->setHorasFaltando($userData['horasFaltando']);
            $horasCalculadas->setHorasNoMesTrabalhadas($userData['horasNoMesTrabalhadas']);
            $horasCalculadas->setMes($userData['mes']);
            $horasCalculadas->setTotalHorasDiasSemana($userData['totalHorasDiasSemana']);
            $horasCalculadas->setTotalHorasDomingo($userData['totalHorasDomingo']);
            $horasCalculadas->setTotalHorasSabado($userData['totalHorasSabado']);
            $horasCalculadas->setProgresso($userData['progressBar']);

            $entityManager->persist($horasCalculadas);
        }

        $entityManager->flush();

        return new JsonResponse(['message' => 'Dados salvos com sucesso'], JsonResponse::HTTP_OK);
    }
}
