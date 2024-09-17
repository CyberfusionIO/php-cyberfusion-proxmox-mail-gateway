<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Who;

class Ip
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
