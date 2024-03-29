<?php

namespace App\Controller;

use App\Repository\ConcertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe de base pour tous les contrôleurs Symfony
use Symfony\Component\HttpFoundation\JsonResponse; // Utilisé pour créer une réponse JSON
use Symfony\Component\Routing\Annotation\Route; // Utilisé pour définir les routes avec des annotations


class ConcertApiController extends AbstractController
{
    #[Route('/api/concerts', name: 'api_concerts', methods: ['GET'])]
    public function getConcerts(ConcertRepository $concertRepository): JsonResponse
    {
        // Récupérer la liste de tous les concerts depuis le repository
        $concerts = $concertRepository->findAll();
        $concertsArray = [];

        // Parcourir chaque concert pour le transformer en un tableau associatif
        foreach ($concerts as $concert) {
            $concertsArray[] = [
                'id' => $concert->getId(),
                'nom_artiste' => $concert->getNomArtiste(),
                'designation' => $concert->getDesignation(),
                'description' => $concert->getDescription(),
                'date_concert' => $concert->getDateConcert() ? $concert->getDateConcert()->getDateHeure() : null,
                'scene' => $concert->getScene() ? $concert->getScene()->getNomScene() : null,
                'musique' => $concert->getMusique() ? $concert->getMusique()->getStyleMusique() : null,
                'image' => $concert->getImage(),
                'day' => $concert->getDateConcert() ? $concert->getDateConcert()->getDay() : null,
                // Ajoutez ici d'autres propriétés que vous souhaitez inclure
            ];
        }

        // Créer une réponse JSON et y inclure les concerts au format JSON
        $response = new JsonResponse();
        $response->setContent(json_encode($concertsArray, JSON_UNESCAPED_UNICODE));

        return $response;
    }
}
