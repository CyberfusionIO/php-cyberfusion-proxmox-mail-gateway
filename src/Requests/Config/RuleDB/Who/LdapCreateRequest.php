<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class LdapCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $mode Operational mode. You can either match 'any' user, match when no such user exists with 'none', or match when the user is member of a specific group.
     * @param string|null $group LDAP Group DN
     * @param string|null $profile Profile ID.
     */
    public function __construct(
        public int $ogroup,
        public string $mode,
        public ?string $group = null,
        public ?string $profile = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'mode' => $this->mode,
            'group' => $this->group,
            'profile' => $this->profile,
        ], fn($value) => $value !== null);
    }
}
