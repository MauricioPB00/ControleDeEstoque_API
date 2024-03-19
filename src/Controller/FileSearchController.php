<?php

namespace App\Controller;

use App\Entity\UserDateTime;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class FileSearchController extends AbstractController
{
    /**
     * @Route("/api/user/{userId}/file", name="api_user_file", methods={"GET"})
     */
    public function getfile($userId, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($userId);

        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $filePath = $user->getFile(); 

        return new JsonResponse(['file_path' => $filePath]);
    }
}