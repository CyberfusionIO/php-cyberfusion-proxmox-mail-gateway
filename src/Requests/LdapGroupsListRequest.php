<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class LdapGroupsListRequest
{
    /**
     * @param string $profile Profile ID.
     */
    public function __construct(
        public string $profile,
    ) {
    }
}
