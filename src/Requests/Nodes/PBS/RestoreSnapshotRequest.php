<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\PBS;

class RestoreSnapshotRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $remote Proxmox Backup Server ID.
     * @param string $backupId backup-id (hostname) of backup snapshot
     * @param string $backupTime backup-time to restore
     * @param bool $config Restore system configuration.
     * @param bool $database Restore the rule database. This is the default.
     * @param bool $statistic Restore statistic databases. Only considered when you restore the 'database'.
     */
    public function __construct(
        public string $node,
        public string $remote,
        public string $backupId,
        public string $backupTime,
        public bool $config = false,
        public bool $database = true,
        public bool $statistic = false,
    ) {
    }
}
