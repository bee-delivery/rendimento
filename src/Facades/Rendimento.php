<?php

namespace BeeDelivery\BancoRendimento\Facades;

use Illuminate\Support\Facades\Facade;

class Rendimento extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rendimento';
    }
}
