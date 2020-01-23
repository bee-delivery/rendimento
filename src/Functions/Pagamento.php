<?php

namespace BeeDelivery\BancoRendimento\Functions;

use BeeDelivery\BancoRendimento\Connection;

class Pagamento
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
     * Faz nova transferencia TED
     *
     * @param Array $params
     * @return Array
     */
    public function fazerTED($params)
    {
        return $this->http->post('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Transacoes/IncluirTransferencia', ['json' => $params]);
    }

    /**
     * Faz nova transferencia TEF
     *
     * @param Array $params
     * @return Array
     */
    public function fazerTEF($params)
    {
        return $this->http->post('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Transacoes/IncluirTransferencia', ['json' => $params]);
    }

    /**
     * Pagar boleto
     *
     * @param Array $params
     * @return Array
     */
    public function pagarBoleto($params)
    {
        return $this->http->post('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Transacoes/IncluirTitulo', ['json' => $params]);
    }

    /**
     * Pagar contas de consumo
     *
     * @param Array $params
     *  @return Array
     */
    public function pagarContasDeConsumo($params)
    {
        return $this->http->post('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Transacoes/IncluirContaConsumo', ['json' => $params]);
    }

    /**
     * Pagar tributos
     *
     * @param Array $params
     *  @return Array
     */
    public function pagarTributos($params)
    {
        return $this->http->post('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Transacoes/IncluirTributo', ['json' => $params]);
    }

    /**
     * Busca por uma transação
     *
     * @param string $transacaoId
     * @return Array
     */
    public function consultarPorId($transacaoId)
    {
        return $this->http->get('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Transacoes/ObterPorId?transacaoId=' . $transacaoId);
    }

    /**
     * Consultar transações e pagamentos por lote
     *
     * @param string $dataInicio
     * @param string $dataFim
     * @return Array
     */
    public function consultarPorLote($dataInicio = null, $dataFim = null)
    {
        return $this->http->get('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Transacoes/Obter?DataInicio=' . $dataInicio . '&DataFim=' . $dataFim);
    }

    /**
     * Consultar transações e pagamentos por lote
     *
     * @param string $transacaoId
     * @return Array
     */
    public function consultarDadosBoleto($params)
    {
        return $this->http->post('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Transacoes/ConsultarDadosDoBoleto', ['json' => $params]);
    }
}
