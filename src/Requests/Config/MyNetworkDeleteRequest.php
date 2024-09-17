<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class MyNetworkDeleteRequest
{
    /**
     * @param string $cidr IPv4 or IPv6 network in CIDR notation.
     */
    public function __construct(
        public string $cidr,
    ) {
    }
}
