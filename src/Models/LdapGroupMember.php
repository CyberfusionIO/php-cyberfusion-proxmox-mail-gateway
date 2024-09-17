<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class LdapGroupMember
{
    /**
     * @param string $account User account
     * @param string $dn Distinguished Name of the user
     * @param string $pmail Primary email of the user
     */
    public function __construct(
        public string $account,
        public string $dn,
        public string $pmail,
    ) {
    }
}
