<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class IpCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $ip IP address
     */
    public function __construct(
        public int $ogroup,
        public string $ip,
    ) {
    }
}
