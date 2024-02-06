<?php

namespace App\Controller;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    // Endpoint pour récupérer toutes les locations
    #[Route('/api/locations', name: 'get_locations', methods: ['GET'])]
    public function getLocations(EntityManagerInterface $em): JsonResponse
    {
        // Récupérer toutes les locations depuis le EntityManager
        $locations = $em->getRepository(Location::class)->findAll();

        // Initialiser un tableau pour stocker les données des locations
        $locationsArray = [];
        foreach ($locations as $location) {
            // Ajouter les données de chaque location dans le tableau
            $locationsArray[] = [
                'id' => $location->getId(),
                'category' => $location->getCategory(),
                'coordinates' => $location->getCoordinates(),
                'icon' => $location->getIcon(),
                'name' => $location->getName(),
                'popupContent' => $location->getPopupContent(),
                'image' => $location->getImage(),
                'updatedAt' => $location->getUpdatedAt(),
            ];
        }

        // Retourner les données des locations sous forme de réponse JSON
        return $this->json($locationsArray);
    }
}
