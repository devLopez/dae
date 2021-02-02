<?php

namespace Igrejanet\DAE;

use Carbon\Carbon;
use Exception;
use Igrejanet\DAE\Factories\LinhaDigitavelFactory;
use stdClass;

/**
 * Dae
 *
 * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
 * @version 2.0.0
 * @package Igrejanet\Dae
 */
class DAE
{
    protected string $nome;

    protected string $endereco;

    protected string $municipio;

    protected string $uf;

    protected string $telefone;

    protected string $documento;

    protected int $servico;

    protected string $cobranca;

    protected Carbon $vencimento;

    protected int $tipoIdentificacao;

    protected string $mesReferencia;

    protected string $historico;

    protected float $valor;

    protected ?string $codigoMunicipio = null;

    protected float $acrescimos = 0.00;

    protected float $juros = 0.00;

    protected string $nossoNumero;

    protected stdClass $linhaDigitavel;

    protected int $orgaoDestino;

    protected string $empresa;

    protected int $taxa = 0;

    protected int $codigoEstadual;

    public function __construct(array $dados)
    {
        foreach ($dados as $key => $item) {
            $method = 'set' . ucfirst($key);

            $this->$method($item);
        }

        $this->geraNossoNumero();
    }

    protected function geraNossoNumero()
    {
        $nossoNumero = fillZero($this->servico, 2) . fillZero($this->cobranca, 9);
        $nossoNumero .= digitoVerificador($nossoNumero);

        $this->geraCodigoBarras($nossoNumero);

        $this->nossoNumero = preg_replace('/([0-9]{2})([0-9]{9})([0-9]{2})/', '\1-\2/\3', $nossoNumero);
    }

    protected function geraCodigoBarras(string $nossoNumero)
    {
        $this->linhaDigitavel = LinhaDigitavelFactory::make($this, $nossoNumero);
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return  $this
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param string $endereco
     * @return  $this
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * @return string
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param string $municipio
     * @return  $this
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param string $uf
     * @return  $this
     * @throws  Exception
     */
    public function setUf($uf)
    {
        if (strlen($uf) != 2) {
            throw new Exception('A UF deve conter 2 caracteres');
        }

        $this->uf = $uf;

        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return  $this
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param string $documento
     * @return  $this;
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return int
     */
    public function getServico()
    {
        return $this->servico;
    }

    /**
     * @param int $servico
     * @return  $this
     */
    public function setServico($servico)
    {
        $this->servico = $servico;

        return $this;
    }

    /**
     * @return string
     */
    public function getCobranca()
    {
        return $this->cobranca;
    }

    /**
     * @param string $cobranca
     * @return  $this;
     */
    public function setCobranca($cobranca)
    {
        $this->cobranca = $cobranca;

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getVencimento()
    {
        return $this->vencimento;
    }

    /**
     * @param Carbon $vencimento
     * @return  $this
     */
    public function setVencimento(Carbon $vencimento)
    {
        $this->vencimento = $vencimento;

        return $this;
    }

    /**
     * @return int
     */
    public function getTipoIdentificacao()
    {
        return $this->tipoIdentificacao;
    }

    /**
     * @param int $tipoIdentificacao
     * @return  $this
     */
    public function setTipoIdentificacao($tipoIdentificacao)
    {
        $this->tipoIdentificacao = $tipoIdentificacao;

        return $this;
    }

    /**
     * @return string
     */
    public function getMesReferencia()
    {
        return $this->mesReferencia;
    }

    /**
     * @param string $mesReferencia
     * @return  $this
     */
    public function setMesReferencia($mesReferencia)
    {
        $this->mesReferencia = $mesReferencia;

        return $this;
    }

    /**
     * @return string
     */
    public function getHistorico()
    {
        return $this->historico;
    }

    /**
     * @param string $historico
     * @return  $this
     */
    public function setHistorico($historico)
    {
        $this->historico = $historico;

        return $this;
    }

    /**
     * @return float|int|string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param float|int|string $valor
     * @return  $this
     */
    public function setValor($valor)
    {
        $this->valor = number_format($valor, 2, ',', '');

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCodigoMunicipio()
    {
        return $this->codigoMunicipio;
    }

    /**
     * @param string|null $codigoMunicipio
     * @return  $this
     */
    public function setCodigoMunicipio($codigoMunicipio)
    {
        $this->codigoMunicipio = $codigoMunicipio;

        return $this;
    }

    /**
     * @return int
     */
    public function getAcrescimos()
    {
        return $this->acrescimos;
    }

    /**
     * @param int $acrescimos
     * @return  $this
     */
    public function setAcrescimos($acrescimos)
    {
        $this->acrescimos = $acrescimos;

        return $this;
    }

    /**
     * @return int
     */
    public function getJuros()
    {
        return $this->juros;
    }

    /**
     * @param int $juros
     * @return  $this
     */
    public function setJuros($juros)
    {
        $this->juros = $juros;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrgaoDestino()
    {
        return $this->orgaoDestino;
    }

    /**
     * @param int $orgaoDestino
     * @return  $this
     */
    public function setOrgaoDestino($orgaoDestino)
    {
        $this->orgaoDestino = $orgaoDestino;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param string $empresa
     * @return  $this
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * @return int
     */
    public function getTaxa()
    {
        return $this->taxa;
    }

    /**
     * @param int $taxa
     */
    public function setTaxa($taxa)
    {
        $this->taxa = $taxa;
    }

    /**
     * @return int
     */
    public function getCodigoEstadual()
    {
        return $this->codigoEstadual;
    }

    /**
     * @param int $codigoEstadual
     */
    public function setCodigoEstadual($codigoEstadual)
    {
        $this->codigoEstadual = $codigoEstadual;
    }

    /**
     * @return false|string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @return false|string
     */
    public function render()
    {
        ob_start();

        $data = get_object_vars($this);

        extract($data);

        include(__DIR__ . '/../resources/view/dae.phtml');

        return ob_get_clean();
    }
}