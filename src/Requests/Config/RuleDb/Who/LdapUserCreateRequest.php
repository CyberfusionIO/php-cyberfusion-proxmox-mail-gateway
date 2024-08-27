<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who;

class LdapUserCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $account LDAP user account name.
     * @param string $profile Profile ID.
     */
    public function __construct(
        public int $ogroup,
        public string $account,
        public string $profile,
    ) {
    }

    public function toArray(): array
    {
        return [
            'account' => $this->account,
            'profile' => $this->profile,
        ];
    }
}
