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
            // Ajoutez ici d'autres propriétés que vous souhaitez inclure
                'date_concert' => $concert->getDateConcert(),
                'scene' => $concert->getScene(),
                'musique' => $concert->getMusique(),
                'image' => $concert->getImage(),// Ajoutez ici d'autres propriétés que vous souhaitez inclure
            ];
        }

        return new JsonResponse($concertsArray);
    }
}