<?php

namespace BeeDelivery\BancoRendimento;

use BeeDelivery\BancoRendimento\Functions\AuthSensedia;
use BeeDelivery\BancoRendimento\Functions\Cobranca;
use BeeDelivery\BancoRendimento\Functions\ContaCorrente;
use BeeDelivery\BancoRendimento\Functions\Pagamento;

class Rendimento
{

    public function cobranca($access_token){
        return new Cobranca($access_token);
    }

    public function contaCorrente($access_token){
        return new ContaCorrente($access_token);
    }

    public function pagamento($access_token){
        return new Pagamento($access_token);
    }

    public function authSensedia(){
        return new AuthSensedia();
    }

}