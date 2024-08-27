<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class PbsRemoteGetRequest
{
    /**
     * @param string $remote Proxmox Backup Server ID.
     */
    public function __construct(
        public string $remote,
    ) {
    }
}
