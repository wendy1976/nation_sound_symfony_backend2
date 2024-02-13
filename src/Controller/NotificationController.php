<?php

namespace App\Controller;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface; // Utilisé pour interagir avec la base de données via Doctrine
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe de base pour tous les contrôleurs Symfony
use Symfony\Component\HttpFoundation\JsonResponse; // Utilisé pour créer une réponse JSON
use Symfony\Component\Routing\Annotation\Route; // Utilisé pour définir les routes avec des annotations

class NotificationController extends AbstractController
{
    // Endpoint pour récupérer toutes les notifications
    #[Route('/api/notifications', name: 'get_notifications', methods: ['GET'])]
    public function getNotifications(EntityManagerInterface $em): JsonResponse
    {
        // Récupérer toutes les notifications depuis le EntityManager
        $notifications = $em->getRepository(Notification::class)->findAll();

        // Initialiser un tableau pour stocker les données des notifications
        $notificationsArray = [];
        foreach ($notifications as $notification) {
            // Ajouter les données de chaque notification dans le tableau
            $notificationsArray[] = [
                'id' => $notification->getId(),
                'title' => $notification->getTitle(),
                'body' => $notification->getBody(),
                'externalLink' => $notification->getExternalLink(),
            ];
        }

        // Retourner les données des notifications sous forme de réponse JSON
        return $this->json($notificationsArray);
    }
}
