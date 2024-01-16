<?php

namespace App\Controller;

use App\Entity\NotificationInfo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NotificationInfoController extends AbstractController
{
    #[Route('/api/notificationInfos', name: 'get_notificationInfos', methods: ['GET'])]
    public function getNotificationInfos(EntityManagerInterface $em): JsonResponse
    {
        $notificationInfos = $em->getRepository(NotificationInfo::class)->findAll();

        $notificationInfosArray = [];
        foreach ($notificationInfos as $notificationInfo) {
            $notificationInfosArray[] = [
                'id' => $notificationInfo->getId(),
                'title' => $notificationInfo->getTitle(),
                'body' => $notificationInfo->getBody(),
                'internalLink' => $notificationInfo->getInternalLink(),
            ];
        }

        return $this->json($notificationInfosArray);
    }
}