<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class TlsInboundDomainDeleteRequest
{
    /**
     * @param string $domain Domain which should be removed from tls_inbound_domains
     */
    public function __construct(
        public string $domain,
    ) {
    }
}
