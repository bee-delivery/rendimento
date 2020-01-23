<?php

namespace BeeDelivery\BancoRendimento\Functions;

use BeeDelivery\BancoRendimento\Connection;

class Cobranca
{

    public $http;
    protected $cobranca;
    protected $agencia;
    protected $contaCorrente;

    public function __construct($apiKey)
    {
        $this->http = new Connection($apiKey);
        $this->agencia = config('rendimento.Agencia');
        $this->contaCorrente = config('rendimento.ContaCorrente');
    }

    /**
     * Incluir instrucao
     *
     * @param Array $params 
     * @return Array
     */
    public function incluirInstrucao($params)
    {
        return $this->http->post('/pagamentosIB/api/v1/Instrucoes/' . $this->agencia . '/' . $this->contaCorrente . '/Instrucao/Incluir', ['json' => $params]);
    }

    /**
     * Incluir título em prioridade
     *
     * @param Array $params 
     * @return Array
     */
    public function incluirTituloPrioridade($params)
    {
        return $this->http->post('/pagamentosIB/api/v1/Titulos/' . $this->agencia . '/' . $this->contaCorrente . '/Titulo/Incluir', ['json' => $params]);
    }

    /**
     * Consultar boleto
     *
     * @param string $nossoNumero
     * @return Array
     */
    public function consultarBoleto($nossoNumero)
    {
        return $this->http->get('/pagamentosIB/api/v1/Titulos/' . $this->agencia . '/' . $this->contaCorrente . '/Boleto/Obter?nossoNumero=' . $nossoNumero);
    }

    /**
     * Consultar títulos
     *
     * @param string $codigoProduto
     * @param string $dataInicio
     * @param string $dataFim
     * @param string $codigoBanco
     * @param string $seuNumero
     * @param string $nossoNumero
     * @param string $nossoNumeroBancos
     * @param string $cpfCnpjPagador
     * @return Array
     */
    public function consultarTitulos($codigoProduto = null, $dataInicio = null, $dataFim = null, $codigoBanco = null, $seuNumero = null, $nossoNumero = null, $nossoNumeroBancos = null, $cpfCnpjPagador = null)
    {
        return $this->http->get('/pagamentosIB/api/v1/Titulos/' . $this->agencia . '/' . $this->contaCorrente . '/Titulo/Obter?codigoPesquisa=T&codigoProduto='
            . $codigoProduto . '&dataInicio=' . $dataInicio . '&dataFim=' . $dataFim . '&codigoBanco=' . $codigoBanco . '&seuNumero=' . $seuNumero . '&nossoNumero='
            . $nossoNumero . '&nossoNumeroBancos=' . $nossoNumeroBancos . '&cpfCnpjPagador=' . $cpfCnpjPagador);
    }

    /**
     * Consultar instrução
     *
     * @param string $seuNumero
     * @param string $codigoProduto
     * @param string $dataInicio
     * @param string $dataFim
     * @param string $nossoNumero
     * @param string $numeroCarteira
     * @return Array
     */
    public function consultarInstrucao($seuNumero = null, $codigoProduto = null, $dataInicio = null, $dataFim = null, $codigoInstrucao = null, $nossoNumero = null, $numeroCarteira = null)
    {
        return $this->http->get('/pagamentosIB/api/v1/Instrucoes/' . $this->agencia . '/' . $this->contaCorrente . '/Instrucao/Obter?seuNumero='
            . $seuNumero . '&codigoProduto=' . $codigoProduto . '&dataInicio=' . $dataInicio . '&dataFim=' . $dataFim . '&codigoInstrucao='
            . $codigoInstrucao . '&nossoNumero=' . $nossoNumero . '&numeroCarteira=' . $numeroCarteira);
    }

    /**
     * Consultar francesinha
     *
     * @param string $codigoProduto
     * @param string $pagina
     * @param string $limite
     * @param string $dataInicio
     * @param string $dataFim
     * @return Array
     */
    public function consultarFrancesinha($codigoProduto = null, $pagina = null, $limite = null, $dataInicio = null, $dataFim = null)
    {
        return $this->http->get('/pagamentosIB/api/v1/Francesinha/' . $this->agencia . '/' . $this->contaCorrente . '/Francesinha/Obter?codigoProduto'
            . $codigoProduto . '&pagina=' . $pagina . '&limite=' . $limite . '&dataInicio=' . $dataInicio . '&dataFim=' . $dataFim);
    }
}
