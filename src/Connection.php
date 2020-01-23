<?php

namespace BeeDelivery\BancoRendimento;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Connection {
    
    protected $http;
    protected $access_token;
    protected $enderecoAPI;
    protected $autenticacao;
    protected $chaveAcesso;
    protected $client_id;
    
    public function __construct($access_token = null) {

        $this->access_token = $access_token;

        $this->enderecoAPI = config('rendimento.EnderecoAPI');
        $this->autenticacao = config('rendimento.autenticacao');
        $this->chaveAcesso = config('rendimento.ChaveAcesso');
        $this->client_id = config('rendimento.client_id');

        $headers = $access_token? 
        [
            'Content-Type' => 'application/json',
            'ChaveAcesso'  => $this->chaveAcesso,
            'client_id'    => $this->client_id,
            'access_token' => $this->access_token,
        ] : [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => $this->autenticacao,
        ];

        $this->http = new Client([
            'headers' => $headers
        ]);
        
        return $this->http;
    }
    
    public function get($url)
    {
        try {
            $response = $this->http->get($this->enderecoAPI . $url);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }
    
    public function post($url, $params)
    {
        try {
            $response = $this->http->post($this->enderecoAPI . $url, $params);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function delete($url)
    {
        $response = $this->http->delete($this->enderecoAPI . $url);

        return json_decode($response->getBody()->getContents(), true);
    }
    
}