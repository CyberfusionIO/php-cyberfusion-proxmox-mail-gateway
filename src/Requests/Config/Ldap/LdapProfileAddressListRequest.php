<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Ldap;

class LdapProfileAddressListRequest
{
    /**
     * @param string $profile Profile ID.
     * @param string $email Email address.
     */
    public function __construct(
        public string $profile,
        public string $email,
    ) {
    }
}
