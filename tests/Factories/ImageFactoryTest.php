<?php

namespace Tests\Factories;

use Igrejanet\Dae\Factories\BarcodeFactory;
use Igrejanet\Dae\Factories\ImageFactory;
use PHPUnit\Framework\TestCase;

class ImageFactoryTest extends TestCase
{
    public function testMake()
    {
        $barcode    = BarcodeFactory::make(123456);
        $image      = ImageFactory::make($barcode);

        $this->assertInternalType('string', $image);
    }
}
