<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class TlsInboundDomainCreateRequest
{
    /**
     * @param string $domain Domain for which TLS should be enforced on incoming connections
     */
    public function __construct(
        public string $domain,
    ) {
    }

    /**
     * Convert the request to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'domain' => $this->domain,
        ];
    }
}
