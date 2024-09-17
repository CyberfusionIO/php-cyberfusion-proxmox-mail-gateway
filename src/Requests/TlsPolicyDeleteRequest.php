<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class TlsPolicyDeleteRequest
{
    /**
     * @param string $destination Destination (Domain or next-hop).
     */
    public function __construct(
        public string $destination,
    ) {
    }
}
