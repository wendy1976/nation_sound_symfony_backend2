<?php

namespace App\Controller;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

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
