<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class NetworkUpdateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $id Object ID.
     * @param string $cidr Network address in CIDR notation.
     */
    public function __construct(
        public int $ogroup,
        public int $id,
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
