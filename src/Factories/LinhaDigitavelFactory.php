<?php

namespace Igrejanet\Dae\Factories;

use Igrejanet\Dae\Dae;
use Igrejanet\Dae\Factories\BarcodeFactory;
use Igrejanet\Dae\Factories\ImageFactory;
use stdClass;

/**
 * LinhaDigitavelFactory
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 1.0.0
 * @since   04/01/2018
 * @package Igrejanet\Dae\Factories
 */
class LinhaDigitavelFactory
{
    const VERSAO_DAE = 12;

    /**
     * @param   Dae  $dae
     * @param   string  $nossoNumero
     * @return  stdClass
     */
    public static function make(Dae $dae, $nossoNumero)
    {
        $inicio         = $dae->getCodigoEstadual();
        $empresa        = $dae->getEmpresa();
        $valor          = $dae->getValor();
        $vencimento     = $dae->getVencimento()->format('ymd');
        $orgaoDestino   = $dae->getOrgaoDestino();
        $taxa           = $dae->getTaxa();

        // Deixamos o valor plano, sem pontuação, e preenche com zeros à esquerda
        $valor  = fillZero(preg_replace('/[\.,]/','', $valor),11);
        $versao = self::VERSAO_DAE;

        $campos = $valor.$empresa.$vencimento.$versao.$nossoNumero.$taxa.$orgaoDestino;

        $codigoBarra = $inicio . modulo10($inicio . $campos) . $campos;

        $linhaDigitavel = preg_replace_callback('/([0-9]{11})/', function($match) {
            return $match[1] . ' '. modulo10($match[1]) . ' ';
        }, $codigoBarra);

        $barcode    = BarcodeFactory::make($codigoBarra, 50);
        $image      = ImageFactory::make($barcode);

        $barra = new stdClass();
        $barra->linhaDigitavel  = $linhaDigitavel;
        $barra->numeroBarra     = $codigoBarra;
        $barra->codigoImpresso  = $image;

        return $barra;
    }
}