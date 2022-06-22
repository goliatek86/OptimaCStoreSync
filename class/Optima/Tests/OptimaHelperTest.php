<?php

namespace Optima\Helpers;

use PHPUnit\Framework\TestCase;

class OptimaHelperTest extends TestCase
{
    public function testGetCountryIdFromIso() : void
    {
        $this->assertString(OptimaHelper::getCountryIdFromIso());
        $this->assertEquals('217', OptimaHelper::getCountryIdFromIso('UAE'));
    }
}
