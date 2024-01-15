<?php

namespace App\Service;

class PushNotificationService
{
    public function createNotification()
    {
        $title = 'Alerte météo';
        $body = 'Attention alerte météo: averses prévues le 21 Juin vers 18H!';

        // Retournez les données de la notification
        return ['title' => $title, 'body' => $body];
    }
}