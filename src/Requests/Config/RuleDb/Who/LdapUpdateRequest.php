<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who;

class LdapUpdateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $id Object ID.
     * @param string|null $group LDAP Group DN
     * @param string|null $mode Operational mode. You can either match 'any' user, match when no such user exists with 'none', or match when the user is member of a specific group.
     * @param string|null $profile Profile ID.
     */
    public function __construct(
        public int $ogroup,
        public int $id,
        public ?string $group = null,
        public ?string $mode = null,
        public ?string $profile = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'group' => $this->group,
            'mode' => $this->mode,
            'profile' => $this->profile,
        ], fn($value) => $value !== null);
    }
}
