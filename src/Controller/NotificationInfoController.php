<?php

namespace App\Controller;

use App\Entity\NotificationInfo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NotificationInfoController extends AbstractController
{
    // Endpoint pour récupérer toutes les informations de notification
    #[Route('/api/notificationInfos', name: 'get_notificationInfos', methods: ['GET'])]
    public function getNotificationInfos(EntityManagerInterface $em): JsonResponse
    {
        // Récupérer toutes les informations de notification depuis le EntityManager
        $notificationInfos = $em->getRepository(NotificationInfo::class)->findAll();

        // Initialiser un tableau pour stocker les données des informations de notification
        $notificationInfosArray = [];
        foreach ($notificationInfos as $notificationInfo) {
            // Ajouter les données de chaque information de notification dans le tableau
            $notificationInfosArray[] = [
                'id' => $notificationInfo->getId(),
                'title' => $notificationInfo->getTitle(),
                'body' => $notificationInfo->getBody(),
                'internalLink' => $notificationInfo->getInternalLink(),
            ];
        }

        // Retourner les données des informations de notification sous forme de réponse JSON
        return $this->json($notificationInfosArray);
    }
}
