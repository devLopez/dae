<?php

namespace Igrejanet\Dae\Factories;

use Zend\Barcode\Barcode;
use Zend\Barcode\Object\Code25interleaved;

/**
 * BarcodeFactory
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   04/01/2019
 * @package Igrejanet\Dae\Factories
 */
class BarcodeFactory
{
    /**
     * @param   string  $text
     * @param   int  $barHeight
     * @return  \Zend\Barcode\Renderer\RendererInterface|\Zend\Barcode\Renderer\Image
     */
    public static function make($text, $barHeight = 80)
    {
        $barcodeOptions     = ['text' => $text, 'drawText'  => false, 'barheight' => $barHeight];
        $rendererOptions    = ['imageType' => 'jpg'];

        return Barcode::factory(new Code25interleaved($barcodeOptions, $rendererOptions),'image');
    }
}