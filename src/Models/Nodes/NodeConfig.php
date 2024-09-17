<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class NodeConfig
{
    /**
     * @param string|null $acme Node specific ACME settings.
     * @param array|null $acmeDomains ACME domain and validation plugin.
     * @param string|null $digest SHA1 digest of the configuration file.
     */
    public function __construct(
        public ?string $acme = null,
        public ?array $acmeDomains = null,
        public ?string $digest = null,
    ) {
    }
}
