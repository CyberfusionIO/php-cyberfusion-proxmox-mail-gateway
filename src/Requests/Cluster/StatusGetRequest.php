<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Cluster;

class StatusGetRequest
{
    /**
     * @param bool $list_single_node List local node if there is no cluster defined. Please note that RSA keys and fingerprint are not valid in that case.
     */
    public function __construct(
        public bool $list_single_node = false,
    ) {
    }

    public function toArray(): array
    {
        return [
            'list_single_node' => $this->list_single_node ? 1 : 0,
        ];
    }
}
