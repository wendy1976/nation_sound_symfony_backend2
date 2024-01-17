<?php

namespace App\Controller;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    #[Route('/api/locations', name: 'get_locations', methods: ['GET'])]
    public function getLocations(EntityManagerInterface $em): JsonResponse
    {
        $locations = $em->getRepository(Location::class)->findAll();

        $locationsArray = [];
        foreach ($locations as $location) {
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

        return $this->json($locationsArray);
    }
}