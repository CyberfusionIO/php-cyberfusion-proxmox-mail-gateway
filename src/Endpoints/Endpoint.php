<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints;

use Cyberfusion\ProxmoxMGW\Client;

abstract class Endpoint
{
    public function __construct(
        protected Client $client,
    ) {
    }
}
