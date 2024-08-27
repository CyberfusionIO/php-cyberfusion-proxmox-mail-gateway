<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class TlsPolicy
{
    /**
     * @param string $destination Destination (Domain or next-hop).
     * @param string $policy TLS policy
     */
    public function __construct(
        public string $destination,
        public string $policy,
    ) {
    }
}
