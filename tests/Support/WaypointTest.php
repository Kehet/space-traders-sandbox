<?php

namespace Tests\Support;

use App\Support\Waypoint;
use PHPUnit\Framework\TestCase;

class WaypointTest extends TestCase
{

    public function testFromSector(): void
    {
        $waypoint = Waypoint::from('X1');

        $this->assertEquals('X1', $waypoint->sector);
        $this->assertNull($waypoint->system);
        $this->assertNull($waypoint->waypoint);
    }

    public function testFromSystem(): void
    {
        $waypoint = Waypoint::from('X1-DF55');

        $this->assertEquals('X1', $waypoint->sector);
        $this->assertEquals('X1-DF55', $waypoint->system);
        $this->assertNull($waypoint->waypoint);
    }

    public function testFromWaypoint(): void
    {
        $waypoint = Waypoint::from('X1-DF55-20250Z');

        $this->assertEquals('X1', $waypoint->sector);
        $this->assertEquals('X1-DF55', $waypoint->system);
        $this->assertEquals('X1-DF55-20250Z', $waypoint->waypoint);
    }

}
