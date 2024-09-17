<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class LdapGroup
{
    /**
     * @param string $dn Distinguished Name of the group
     * @param int $gid Group ID
     */
    public function __construct(
        public string $dn,
        public int $gid,
    ) {
    }
}
