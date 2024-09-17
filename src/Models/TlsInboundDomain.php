<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class TlsInboundDomain
{
    /**
     * @param string $domain Domain for which TLS should be enforced on incoming connections
     */
    public function __construct(
        public string $domain,
    ) {
    }
}
