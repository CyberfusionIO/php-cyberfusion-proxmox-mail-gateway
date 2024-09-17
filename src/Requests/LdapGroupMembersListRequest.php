<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class LdapGroupMembersListRequest
{
    /**
     * @param string $profile Profile ID.
     * @param int $gid Group ID
     */
    public function __construct(
        public string $profile,
        public int $gid,
    ) {
    }
}
