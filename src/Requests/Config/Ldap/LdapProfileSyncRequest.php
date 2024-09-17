<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Ldap;

class LdapProfileSyncRequest
{
    /**
     * @param string $profile Profile ID.
     */
    public function __construct(
        public string $profile,
    ) {
    }
}
