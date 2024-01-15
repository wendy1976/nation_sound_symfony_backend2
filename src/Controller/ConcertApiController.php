<?php

namespace App\Controller;

use App\Repository\ConcertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ConcertApiController extends AbstractController
{
    #[Route('/api/concerts', name: 'api_concerts', methods: ['GET'])]
    public function getConcerts(ConcertRepository $concertRepository): JsonResponse
    {
        $concerts = $concertRepository->findAll();
        $concertsArray = [];

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
                'day' => $concert->getDateConcert() ? $concert->getDateConcert()->getDay() : null, // Ajoutez cette ligne
                // Ajoutez ici d'autres propriétés que vous souhaitez inclure
            ];
        }

        $response = new JsonResponse();
        $response->setContent(json_encode($concertsArray, JSON_UNESCAPED_UNICODE));

        return $response;
    }
}