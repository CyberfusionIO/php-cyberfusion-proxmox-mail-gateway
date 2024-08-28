<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Node\PBS;

class GetGroupSnapshotsRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $remote Proxmox Backup Server ID.
     * @param string $backupId ID (hostname) of backup snapshot.
     */
    public function __construct(
        public string $node,
        public string $remote,
        public string $backupId,
    ) {
    }
}
