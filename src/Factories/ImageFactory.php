<?php

namespace Igrejanet\DAE\Factories;

use Zend\Barcode\Renderer\Image;

/**
 * ImageFactory
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   04/01/2019
 * @package Igrejanet\Dae\Factories
 */
class ImageFactory
{
    /**
     * @param   Image  $image
     * @return  false|string|Image
     */
    public static function make(Image $image)
    {
        $dir = sys_get_temp_dir();

        if ( ! is_writable($dir) ) {
            $dir = __DIR__ . '/../../resources/barcode';
        }

        $file       = $dir . '/barcode.jpg';
        $renderer   = $image->draw();

        imagejpeg($renderer, $file, 100);

        $image = file_get_contents($file);
        $image = base64_encode($image);

        imagedestroy($renderer);
        unlink($file);

        return $image;
    }
}