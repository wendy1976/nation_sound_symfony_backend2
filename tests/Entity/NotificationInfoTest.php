<?php

namespace App\Tests\Entity;

use App\Entity\NotificationInfo;
use PHPUnit\Framework\TestCase;

class NotificationInfoTest extends TestCase
{
    public function testGetAndSetId()
    {
        $notificationInfo = new NotificationInfo();
        $this->assertNull($notificationInfo->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetTitle()
    {
        $notificationInfo = new NotificationInfo();
        $this->assertNull($notificationInfo->getTitle());

        $notificationInfo->setTitle("Title Test");
        $this->assertSame("Title Test", $notificationInfo->getTitle());
    }

    public function testGetAndSetBody()
    {
        $notificationInfo = new NotificationInfo();
        $this->assertNull($notificationInfo->getBody());

        $notificationInfo->setBody("Body Test");
        $this->assertSame("Body Test", $notificationInfo->getBody());
    }

    public function testGetAndSetInternalLink()
    {
        $notificationInfo = new NotificationInfo();
        $this->assertNull($notificationInfo->getInternalLink());

        $notificationInfo->setInternalLink("Internal Link Test");
        $this->assertSame("Internal Link Test", $notificationInfo->getInternalLink());
    }
}
