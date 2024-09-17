<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\PBS;

class ListTimerRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $remote Proxmox Backup Server ID.
     */
    public function __construct(
        public string $node,
        public string $remote,
    ) {
    }
}
