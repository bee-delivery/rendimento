<?php

namespace BeeDelivery\BancoRendimento\Functions;

use BeeDelivery\BancoRendimento\Connection;

class ContaCorrente
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
     * Realiza nova transferencia TED
     *
     * @return Array
     */
    public function consultarSaldo()
    {
        return $this->http->get('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente . '/Saldo/Obter');
    }
    
    /**
     * Busca por uma transação
     *
     * @param string $dataInicio
     * @param string $dataFim
     * @return Array
     */
    public function consultarExtrato($dataInicio = null, $dataFim = null)
    {
        return $this->http->get('/pagamentosIB/api/v1/ContasCorrentes/' . $this->agencia . '/' . $this->contaCorrente. '/Extrato/Obter?dataInicio=' . $dataInicio . '&dataFim=' . $dataFim);
    }
}