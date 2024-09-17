<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class IpUpdateRequest
{
    /**
     * @param int $id Object ID.
     * @param string $ip IP address
     */
    public function __construct(
        public int $id,
        public string $ip,
    ) {
    }
}
