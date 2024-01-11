<?php

namespace App\Controller;

use App\Repository\PassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PassApiController extends AbstractController
{
    #[Route('/api/passes', name: 'api_passes', methods: ['GET'])]
    public function getPasses(PassRepository $passRepository): Response
    {
        $passes = $passRepository->findAll();
        $passesArray = [];

        foreach ($passes as $pass) {
            $passesArray[] = [
                'id' => $pass->getId(),
                'image_path' => $pass->getImagePath(),
                'nom_pass' => $pass->getNomPass(),
                'description_pass' => strip_tags($pass->getDescriptionPass()),
                'prix_pass' => $pass->getPrixPass(),
            ];
        }

        $jsonContent = json_encode($passesArray, JSON_UNESCAPED_UNICODE);

        return new Response($jsonContent, 200, ['Content-Type' => 'application/json']);
    }
}