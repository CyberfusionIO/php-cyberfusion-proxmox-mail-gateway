<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class TrustedNetwork
{
    /**
     * @param string $cidr IPv4 or IPv6 network in CIDR notation.
     */
    public function __construct(
        public string $cidr,
    ) {
    }
}
