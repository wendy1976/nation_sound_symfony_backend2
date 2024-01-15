<?php

namespace App\Controller;

use App\Service\PushNotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    #[Route('/api/send-notification', name: 'send_notification', methods: ['GET'])]

    public function sendNotification(PushNotificationService $pushNotificationService): JsonResponse
    {
        $notification = $pushNotificationService->createNotification();

        $response = new JsonResponse();
        $response->setContent(json_encode($notification, JSON_UNESCAPED_UNICODE));

        return $response;
    }
}