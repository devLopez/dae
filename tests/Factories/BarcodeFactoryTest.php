<?php

namespace Tests\Factories;

use Igrejanet\DAE\Factories\BarcodeFactory;
use PHPUnit\Framework\TestCase;

class BarcodeFactoryTest extends TestCase
{
    public function testBarcodeFactory()
    {
        $factory = BarcodeFactory::make('123456');

        $this->assertInstanceOf('Zend\Barcode\Renderer\Image', $factory);
    }
}
