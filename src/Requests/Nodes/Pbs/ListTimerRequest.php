<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Pbs;

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
