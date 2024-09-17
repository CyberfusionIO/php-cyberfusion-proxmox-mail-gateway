<?php

namespace Cyberfusion\ProxmoxPVE\Requests\Nodes;

class GetNetworkRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string|null $type Only list specific interface types.
     */
    public function __construct(
        public string $node,
        public ?string $type = null,
    ) {
    }
}
