<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class NetworkCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $cidr Network address in CIDR notation.
     */
    public function __construct(
        public int $ogroup,
        public string $cidr,
    ) {
    }

    public function toArray(): array
    {
        return [
            'cidr' => $this->cidr,
        ];
    }
}
