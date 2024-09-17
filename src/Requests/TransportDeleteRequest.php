<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class TransportDeleteRequest
{
    /**
     * @param string $domain Domain name.
     */
    public function __construct(
        public string $domain,
    ) {
    }
}
