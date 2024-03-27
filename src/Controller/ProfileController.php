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
use Doctrine\ORM\EntityManagerInterface;

class ProfileController extends AbstractController
{
    /**
     * @Route("/api/user/{userId}/profile", name="api_user_profile", methods={"GET"})
     */

    public function getProfile($userId, UserRepository $userRepository, UserDateTimeRepository $userDateTimeRepository): Response
    {
        $user = $userRepository->find($userId);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $userData = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'cpf' => $user->getCpf(),
            'rg' => $user->getRg(),
            'datNasc' => $user->getDatNasc(),
            'cidade' => $user->getCidade(),
            'horTrab' => $user->getHorTrab(),
            'wage' => $user->getWage(),
            'job' => $user->getJob(),
            'horaIni' => $user->getHorIni(),
            'horIniFim' => $user->getHorIniFim(),
            'horIniAft' => $user->getHorIniAft(),
            'horFimAft' => $user->getHorFimAft(),
            'file' => $user->getFile(),
        ];

        return new JsonResponse($userData, Response::HTTP_OK);
    }

    /**
     * @Route("/api/user/profile", name="api_user_all_profile", methods={"GET"})
     */

     public function getAllProfile(UserRepository $userRepository, UserDateTimeRepository $userDateTimeRepository): Response
     {
        $users = $userRepository->findAll();

        $userData = [];

        foreach ($users as $user) {
            $userData[] = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'file' => $user->getFile(),
            ];
        }

        return new JsonResponse($userData, Response::HTTP_OK);
    }

    
   /**
     * @Route("/api/user/{userId}/profile/edit", name="api_user_userid_profile/edit", methods={"POST"})
     */
    public function salveUpdateUser($userId, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->find($userId);

        if (!$user) {
            return new Response("Usuário não encontrado.", Response::HTTP_NOT_FOUND);
        }

        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setName($data['name']);
        $user->setCpf($data['cpf']);
        $user->setRg($data['rg']);
        $user->setDatNasc($data['datNasc']);
        $user->setCidade($data['cidade']);
        $user->setHorTrab($data['horTrab']);
        $user->setWage($data['wage']);
        $user->setJob($data['job']);
        $user->setHorIni($data['horaIni']);
        $user->setHorIniFim($data['horIniFim']);
        $user->setHorIniAft($data['horIniAft']);
        $user->setHorFimAft($data['horFimAft']);

        $entityManager->flush();

        return new JsonResponse($user, Response::HTTP_OK);
       
    }
}
