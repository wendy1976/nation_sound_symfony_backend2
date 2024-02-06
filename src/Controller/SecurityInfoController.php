<?php

namespace App\Controller;

use App\Entity\SecurityInfo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SecurityInfoController extends AbstractController
{
    // Définition de la route pour récupérer les informations de sécurité
    #[Route('/api/securityinfo', name: 'get_securityinfo', methods: ['GET'])]
    public function getSecurityInfo(EntityManagerInterface $em): JsonResponse
    {
        // Récupérer toutes les informations de sécurité depuis la base de données
        $securityInfos = $em->getRepository(SecurityInfo::class)->findAll();

        $securityInfoArray = [];
        // Convertir les informations de sécurité en un tableau associatif pour le format JSON
        foreach ($securityInfos as $securityInfo) {
            $securityInfoArray[] = [
                'id' => $securityInfo->getId(),
                'title' => $securityInfo->getTitle(),
                'body' => $securityInfo->getBody(),
            ];
        }

        // Retourner les informations de sécurité au format JSON
        return $this->json($securityInfoArray);
    }
}
