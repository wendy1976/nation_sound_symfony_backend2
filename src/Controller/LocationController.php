<?php

namespace App\Controller;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface; // Utilisé pour interagir avec la base de données via Doctrine
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe de base pour tous les contrôleurs Symfony
use Symfony\Component\HttpFoundation\JsonResponse; // Utilisé pour créer une réponse JSON
use Symfony\Component\Routing\Annotation\Route; // Utilisé pour définir les routes avec des annotations


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
