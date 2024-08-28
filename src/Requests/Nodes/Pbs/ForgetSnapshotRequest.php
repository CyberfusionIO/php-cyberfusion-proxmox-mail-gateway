<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Pbs;

class ForgetSnapshotRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $remote Proxmox Backup Server ID.
     * @param string $backupId ID (hostname) of backup snapshot
     * @param string $backupTime Backup time in RFC 3339 format
     */
    public function __construct(
        public string $node,
        public string $remote,
        public string $backupId,
        public string $backupTime,
    ) {
    }
}
