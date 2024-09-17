<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Ldap;

class LdapUser
{
    /**
     * @param string $account The user's account name.
     * @param string $dn The user's distinguished name.
     * @param string $pmail The user's primary email address.
     */
    public function __construct(
        public string $account,
        public string $dn,
        public string $pmail,
    ) {
    }
}
