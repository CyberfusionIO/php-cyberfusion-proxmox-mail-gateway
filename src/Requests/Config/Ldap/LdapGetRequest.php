<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Ldap;

class LdapGetRequest
{
    /**
     * @param string $profile Profile ID.
     */
    public function __construct(
        public string $profile,
    ) {
    }
}
