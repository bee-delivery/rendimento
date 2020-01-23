<?php

namespace BeeDelivery\BancoRendimento\Functions;

use BeeDelivery\BancoRendimento\Connection;

class AuthSensedia
{

    public $http;

    public function __construct()
    {
        $this->http = new Connection();
    }

    /**
     * Autenticação no Sensedia. Responsável por adquirir novo access_token
     *
     * @return Array
     */
    public function getAccessToken()
    {
        return $this->http->post('/oauth/access-token', ['form_params' => ['grant_type' => 'client_credentials']]);
    }
}