<?php

namespace App\Tests\Entity;

use App\Entity\SecurityInfo;
use PHPUnit\Framework\TestCase;

class SecurityInfoTest extends TestCase
{
    public function testGetAndSetId()
    {
        $securityInfo = new SecurityInfo();
        $this->assertNull($securityInfo->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetTitle()
    {
        $securityInfo = new SecurityInfo();
        $this->assertNull($securityInfo->getTitle());

        $securityInfo->setTitle("Title Test");
        $this->assertSame("Title Test", $securityInfo->getTitle());
    }

    public function testGetAndSetBody()
    {
        $securityInfo = new SecurityInfo();
        $this->assertNull($securityInfo->getBody());

        $securityInfo->setBody("Body Test");
        $this->assertSame("Body Test", $securityInfo->getBody());
    }
}
