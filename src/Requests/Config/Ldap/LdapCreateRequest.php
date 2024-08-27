<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Ldap;

class LdapCreateRequest
{
    /**
     * @param string $profile Profile ID.
     * @param string $server1 Server address.
     * @param string|null $accountattr Account attribute name name.
     * @param string|null $basedn Base domain name.
     * @param string|null $binddn Bind domain name.
     * @param string|null $bindpw Bind password.
     * @param string|null $cafile Path to CA file. Only useful with option 'verify'
     * @param string|null $comment Description.
     * @param bool|null $disable Flag to disable/deactivate the entry.
     * @param string|null $filter LDAP filter.
     * @param string|null $groupbasedn Base domain name for groups.
     * @param string|null $groupclass List of objectclasses for groups.
     * @param string|null $mailattr List of mail attribute names.
     * @param string|null $mode LDAP protocol mode ('ldap', 'ldaps' or 'ldap+starttls').
     * @param int|null $port Specify the port to connect to.
     * @param string|null $server2 Fallback server address. Used when the first server is not available.
     * @param bool|null $verify Verify server certificate. Only useful with ldaps or ldap+starttls.
     */
    public function __construct(
        public string $profile,
        public string $server1,
        public ?string $accountattr = null,
        public ?string $basedn = null,
        public ?string $binddn = null,
        public ?string $bindpw = null,
        public ?string $cafile = null,
        public ?string $comment = null,
        public ?bool $disable = null,
        public ?string $filter = null,
        public ?string $groupbasedn = null,
        public ?string $groupclass = null,
        public ?string $mailattr = null,
        public ?string $mode = null,
        public ?int $port = null,
        public ?string $server2 = null,
        public ?bool $verify = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'profile' => $this->profile,
            'server1' => $this->server1,
            'accountattr' => $this->accountattr,
            'basedn' => $this->basedn,
            'binddn' => $this->binddn,
            'bindpw' => $this->bindpw,
            'cafile' => $this->cafile,
            'comment' => $this->comment,
            'disable' => $this->disable,
            'filter' => $this->filter,
            'groupbasedn' => $this->groupbasedn,
            'groupclass' => $this->groupclass,
            'mailattr' => $this->mailattr,
            'mode' => $this->mode,
            'port' => $this->port,
            'server2' => $this->server2,
            'verify' => $this->verify,
        ], fn($value) => !is_null($value));
    }
}
