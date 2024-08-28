<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class TransportReadRequest
{
    /**
     * @param string $domain Domain name.
     */
    public function __construct(
        public string $domain,
    ) {
    }
}
