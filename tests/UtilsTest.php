<?php

namespace Tests;

use Igrejanet\DAE\Utils;
use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    public function testFillZero()
    {
        $this->assertEquals('002', Utils::fillZero(2, 3));
    }
}