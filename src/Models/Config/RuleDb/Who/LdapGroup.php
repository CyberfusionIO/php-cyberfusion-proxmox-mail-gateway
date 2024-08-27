<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\Who;

class LdapGroup
{
    /**
     * @param int $id Object ID.
     * @param string|null $group LDAP Group DN
     * @param string|null $mode Operational mode.
     * @param string|null $profile Profile ID.
     */
    public function __construct(
        public int $id,
        public ?string $group = null,
        public ?string $mode = null,
        public ?string $profile = null,
    ) {
    }
}
