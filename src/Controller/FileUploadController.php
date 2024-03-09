<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FileUploadController extends AbstractController
{
    /**
     * @Route("/upload-file", name="upload_file")
     */
    public function upload(Request $request)
    {
        //var_dump($request->files->all());
        
        $file = $request->files->get('foto');
        //echo('<br>');
        //var_dump($file);
        if (!$file) {
            return $this->json(['error' => 'No file uploaded'], 400);
        }

        try {
            $fileName = 'userImg/' . uniqid() . '.' . $file->guessExtension();
            $file->move($this->getParameter('kernel.project_dir') . '/public/assets/', $fileName);

            return $this->json(['message' => 'File uploaded successfully', 'file_path' => $fileName]);
        } catch (FileException $e) {

            return $this->json(['error' => 'File upload failed'], 500);
        }
    }
}
