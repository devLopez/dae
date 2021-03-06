<?php

namespace Tests\Factories;

use Igrejanet\DAE\Factories\BarcodeFactory;
use Laminas\Barcode\Renderer\RendererInterface;
use PHPUnit\Framework\TestCase;

class BarcodeFactoryTest extends TestCase
{
    public function testBarcodeFactory()
    {
        $factory = BarcodeFactory::make('123456');

        $this->assertInstanceOf(RendererInterface::class, $factory);
    }
}
