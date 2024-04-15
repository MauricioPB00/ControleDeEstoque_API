<?php

namespace App\Controller;

use App\Entity\Feriado;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeriadoController extends AbstractController
{

/**
 * @Route("/user/feriado/salvarFeriados", name="api_user_feriado_salvar", methods={"POST"})
 */
public function salvarFeriados(Request $request): Response
{
    // Obtenha os dados enviados pelo Angular
    $dados = json_decode($request->getContent(), true);

    // Aqui você pode validar os dados se necessário

    // Salve os feriados no banco de dados
    $entityManager = $this->getDoctrine()->getManager();
    foreach ($dados as $data) {
        // Verifica se já existe um feriado com a mesma data
        $feriadoExistente = $this->getDoctrine()
            ->getRepository(Feriado::class)
            ->findOneBy(['dia' => new \DateTime($data)]);
        
        // Se não existir, salva o feriado no banco de dados
        if (!$feriadoExistente) {
            $feriado = new Feriado();
            $feriado->setDia(new \DateTime($data)); // Supondo que os dados estejam no formato 'dia' => 'YYYY-MM-DD'
            $entityManager->persist($feriado);
        }
    }
    $entityManager->flush();

    // Responda com uma mensagem de sucesso
    return new JsonResponse(['message' => 'Feriados salvos com sucesso'], Response::HTTP_OK);
}
    /**
     * @Route("/user/feriado/getFeriado", name="api_user_feriado_buscar", methods={"GET"})
     */
    public function buscarFeriados(): Response
    {
        // Busque todas as datas salvas no banco de dados
        $feriadosRepository = $this->getDoctrine()->getRepository(Feriado::class);
        $feriados = $feriadosRepository->findAll();

        // Transforme as datas em um array simples
        $datas = [];
        foreach ($feriados as $feriado) {
            $datas[] = $feriado->getDia()->format('Y-m-d');
        }

        // Responda com as datas salvas
        return new JsonResponse($datas, Response::HTTP_OK);
    }
}
