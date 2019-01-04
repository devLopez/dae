<?php

namespace Tests;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Igrejanet\Dae\Dae;

class DaeTest extends TestCase
{
    public function testDae()
    {
        $data = [
            // Dados do Sacado
            'nome'      => 'Matheus Lopes Santos',
            'endereco'  => 'Rua dos Jesuítas, 88, Nª Sª das Graças',
            'municipio' => 'Montes Claros',
            'uf'        => 'MG',
            'telefone'  => '(38) 99183-9930',
            'documento' => '101.384.146-88',

            // Dados da Cobrança
            'cobranca'          => '201600180',
            'vencimento'        => new Carbon('2019-01-10'),
            'tipoIdentificacao' => 4,
            'mesReferencia'     => date('m/Y'),
            'historico'         => '',
            'valor'             => 90,

            // Dados repassados pelo estado de minas gerais
            'codigoEstadual'    => 856,
            'servico'           => 71,
            'orgaoDestino'      => 321,
            'empresa'           => '0213'
        ];

        $dae = new Dae($data);

        $this->assertInstanceOf('Igrejanet\Dae\Dae', $dae);
        $this->assertInternalType('string', $dae->render());
    }

    public function testHelpers()
    {
        $strZero    = fillZero(71, 7);
        $blanked    = fillBlank(71, 7);

        $this->assertEquals('0000071', $strZero);
        $this->assertEquals('71     ', $blanked);
    }
}
