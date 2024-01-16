<?php

namespace App\Controller;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\PushNotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    #[Route('/api/notifications', name: 'get_notifications', methods: ['GET'])]
public function getNotifications(EntityManagerInterface $em): JsonResponse
{
    $notifications = $em->getRepository(Notification::class)->findAll();

    $notificationsArray = [];
    foreach ($notifications as $notification) {
        $notificationsArray[] = [
            'id' => $notification->getId(),
            'title' => $notification->getTitle(),
            'body' => $notification->getBody(),
            'externalLink' => $notification->getExternalLink(),
        ];
    }

    return $this->json($notificationsArray);
}
}