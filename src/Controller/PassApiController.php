<?php

namespace App\Controller;

use App\Repository\PassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PassApiController extends AbstractController
{
    // Endpoint pour récupérer toutes les passes
    #[Route('/api/passes', name: 'api_passes', methods: ['GET'])]
    public function getPasses(PassRepository $passRepository): Response
    {
        // Récupérer toutes les passes depuis le PassRepository
        $passes = $passRepository->findAll();
        $passesArray = [];

        // Parcourir chaque passe et extraire ses données dans un tableau
        foreach ($passes as $pass) {
            $passesArray[] = [
                'id' => $pass->getId(),
                'image_path' => $pass->getImagePath(),
                'nom_pass' => $pass->getNomPass(),
                'description_pass' => strip_tags($pass->getDescriptionPass()), // Supprimer les balises HTML de la description
                'prix_pass' => $pass->getPrixPass(),
            ];
        }

        // Convertir le tableau de passes en JSON
        $jsonContent = json_encode($passesArray, JSON_UNESCAPED_UNICODE);

        // Retourner une réponse HTTP avec le contenu JSON
        return new Response($jsonContent, 200, ['Content-Type' => 'application/json']);
    }
}
