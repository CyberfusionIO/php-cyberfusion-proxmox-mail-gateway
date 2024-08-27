<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\Who;

class LdapUser
{
    /**
     * @param int $id Object ID.
     * @param string $account LDAP user account name.
     * @param string $profile Profile ID.
     */
    public function __construct(
        public int $id,
        public string $account,
        public string $profile,
    ) {
    }
}
