<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class DnsUpdateRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string|null $dns1 First name server IP address.
     * @param string|null $dns2 Second name server IP address.
     * @param string|null $dns3 Third name server IP address.
     * @param string|null $search Search domain for host-name lookup.
     */
    public function __construct(
        public string $node,
        public ?string $dns1 = null,
        public ?string $dns2 = null,
        public ?string $dns3 = null,
        public ?string $search = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'dns1' => $this->dns1,
            'dns2' => $this->dns2,
            'dns3' => $this->dns3,
            'search' => $this->search,
        ], fn($value) => $value !== null);
    }
}
