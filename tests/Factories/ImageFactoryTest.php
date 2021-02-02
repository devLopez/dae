<?php

namespace Tests\Factories;

use Igrejanet\DAE\Factories\BarcodeFactory;
use Igrejanet\DAE\Factories\ImageFactory;
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
