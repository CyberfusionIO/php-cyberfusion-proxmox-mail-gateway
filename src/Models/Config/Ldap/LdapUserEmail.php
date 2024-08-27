<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Ldap;

class LdapUserEmail
{
    /**
     * @param string $email The email address.
     * @param bool $primary Whether this is the primary email address.
     */
    public function __construct(
        public string $email,
        public bool $primary,
    ) {
    }
}
