<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class SetConfigRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string|null $acme Node specific ACME settings.
     * @param array|null $acmeDomains ACME domain and validation plugin.
     * @param string|null $delete A list of settings you want to delete.
     * @param string|null $digest Prevent changes if current configuration file has different SHA1 digest.
     */
    public function __construct(
        public string $node,
        public ?string $acme = null,
        public ?array $acmeDomains = null,
        public ?string $delete = null,
        public ?string $digest = null,
    ) {
    }
}
