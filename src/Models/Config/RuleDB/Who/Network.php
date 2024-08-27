<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Who;

class Network
{
    /**
     * @param int $id Object ID.
     * @param string $cidr Network address in CIDR notation.
     */
    public function __construct(
        public int $id,
        public string $cidr,
    ) {
    }
}
