<?php

namespace App\Tests\Entity;

use App\Entity\Location;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testGetAndSetId()
    {
        $location = new Location();
        $this->assertNull($location->getId());

        // Note: Vous ne pouvez pas définir l'ID car il est généré automatiquement
    }

    public function testGetAndSetCategory()
    {
        $location = new Location();
        $this->assertNull($location->getCategory());

        $location->setCategory("Category Test");
        $this->assertSame("Category Test", $location->getCategory());
    }

    public function testGetAndSetCoordinates()
    {
        $location = new Location();
        $this->assertEmpty($location->getCoordinates());

        $coordinates = ['lat' => 48.8566, 'lon' => 2.3522];
        $location->setCoordinates($coordinates);
        $this->assertSame($coordinates, $location->getCoordinates());
    }

    public function testGetAndSetName()
    {
        $location = new Location();
        $this->assertNull($location->getName());

        $location->setName("Name Test");
        $this->assertSame("Name Test", $location->getName());
    }

    public function testGetAndSetPopupContent()
    {
        $location = new Location();
        $this->assertNull($location->getPopupContent());

        $location->setPopupContent("Popup Content Test");
        $this->assertSame("Popup Content Test", $location->getPopupContent());
    }
}
