<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class IpUpdateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $id Object ID.
     * @param string $ip IP address
     */
    public function __construct(
        public int $ogroup,
        public int $id,
        public string $ip,
    ) {
    }
}
