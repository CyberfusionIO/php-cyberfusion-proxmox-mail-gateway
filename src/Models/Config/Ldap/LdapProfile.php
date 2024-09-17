<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Ldap;

class LdapProfile
{
    /**
     * @param string $profile Profile ID.
     * @param string $server1 Server address.
     * @param string $mode LDAP protocol mode ('ldap', 'ldaps' or 'ldap+starttls').
     * @param string|null $comment Description.
     * @param bool|null $disable Flag to disable/deactivate the entry.
     * @param int|null $gcount
     * @param int|null $mcount
     * @param string|null $server2 Fallback server address. Used when the first server is not available.
     * @param int|null $ucount
     * @param string|null $accountattr Account attribute name.
     * @param string|null $basedn Base domain name.
     * @param string|null $binddn Bind domain name.
     * @param string|null $bindpw Bind password.
     * @param string|null $cafile Path to CA file. Only useful with option 'verify'.
     * @param string|null $filter LDAP filter.
     * @param string|null $groupbasedn Base domain name for groups.
     * @param string|null $groupclass List of objectclasses for groups.
     * @param string|null $mailattr List of mail attribute names.
     * @param int|null $port Specify the port to connect to.
     * @param bool|null $verify Verify server certificate. Only useful with ldaps or ldap+starttls.
     */
    public function __construct(
        public string $profile,
        public string $server1,
        public string $mode,
        public ?string $comment = null,
        public ?bool $disable = null,
        public ?int $gcount = null,
        public ?int $mcount = null,
        public ?string $server2 = null,
        public ?int $ucount = null,
        public ?string $accountattr = null,
        public ?string $basedn = null,
        public ?string $binddn = null,
        public ?string $bindpw = null,
        public ?string $cafile = null,
        public ?string $filter = null,
        public ?string $groupbasedn = null,
        public ?string $groupclass = null,
        public ?string $mailattr = null,
        public ?int $port = null,
        public ?bool $verify = null,
    ) {
    }
}
