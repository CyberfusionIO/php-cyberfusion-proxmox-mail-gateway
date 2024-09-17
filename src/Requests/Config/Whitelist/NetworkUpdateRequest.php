<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class NetworkUpdateRequest
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
