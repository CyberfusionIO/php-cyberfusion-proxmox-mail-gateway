<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class DnsSettings
{
    /**
     * @param string|null $dns1 First name server IP address.
     * @param string|null $dns2 Second name server IP address.
     * @param string|null $dns3 Third name server IP address.
     * @param string|null $search Search domain for host-name lookup.
     */
    public function __construct(
        public ?string $dns1 = null,
        public ?string $dns2 = null,
        public ?string $dns3 = null,
        public ?string $search = null,
    ) {
    }
}
