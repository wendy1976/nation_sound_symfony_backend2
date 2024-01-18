<?php

namespace App\Controller;

use App\Entity\SecurityInfo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SecurityInfoController extends AbstractController
{
    #[Route('/api/securityinfo', name: 'get_securityinfo', methods: ['GET'])]
    public function getSecurityInfo(EntityManagerInterface $em): JsonResponse
    {
        $securityInfos = $em->getRepository(SecurityInfo::class)->findAll();

        $securityInfoArray = [];
        foreach ($securityInfos as $securityInfo) {
            $securityInfoArray[] = [
                'id' => $securityInfo->getId(),
                'title' => $securityInfo->getTitle(),
                'body' => $securityInfo->getBody(),
            ];
        }

        return $this->json($securityInfoArray);
    }
}