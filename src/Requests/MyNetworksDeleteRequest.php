<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

use Cyberfusion\ProxmoxMGW\Support\Cidr;

class MyNetworksDeleteRequest
{
    public function __construct(
        public string $cidr
    ) {
        $this->cidr = Cidr::full($cidr);
    }
}
