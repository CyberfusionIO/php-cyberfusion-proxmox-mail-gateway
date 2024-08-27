<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class TlsPolicyUpdateRequest
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

    public function toArray(): array
    {
        return [
            'destination' => $this->destination,
            'policy' => $this->policy,
        ];
    }
}
