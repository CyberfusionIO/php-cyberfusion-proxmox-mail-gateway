<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class NetworkCreateRequest
{
    /**
     * @param string $cidr Network address in CIDR notation.
     */
    public function __construct(
        public string $cidr,
    ) {
    }
}
