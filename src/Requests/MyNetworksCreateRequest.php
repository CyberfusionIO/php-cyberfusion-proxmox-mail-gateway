<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

use Cyberfusion\ProxmoxMGW\Support\Cidr;

class MyNetworksCreateRequest
{
    public function __construct(
        public string $cidr,
        public string $comment = '',
    ) {
        $this->cidr = Cidr::full($cidr);
    }
}
