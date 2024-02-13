<?php

namespace App\Tests\Entity;

use App\Entity\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    public function testGetAndSetId()
    {
        $notification = new Notification();
        $this->assertNull($notification->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetTitle()
    {
        $notification = new Notification();
        $this->assertNull($notification->getTitle());

        $notification->setTitle("Title Test");
        $this->assertSame("Title Test", $notification->getTitle());
    }

    public function testGetAndSetBody()
    {
        $notification = new Notification();
        $this->assertNull($notification->getBody());

        $notification->setBody("Body Test");
        $this->assertSame("Body Test", $notification->getBody());
    }

    public function testGetAndSetExternalLink()
    {
        $notification = new Notification();
        $this->assertNull($notification->getExternalLink());

        $notification->setExternalLink("External Link Test");
        $this->assertSame("External Link Test", $notification->getExternalLink());
    }
}
