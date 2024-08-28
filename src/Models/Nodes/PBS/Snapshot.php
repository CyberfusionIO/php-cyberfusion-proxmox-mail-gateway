<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes\PBS;

class Snapshot
{
    /**
     * @param string $backupId The backup ID.
     * @param string $backupTime The backup time.
     * @param string $ctime The creation time.
     * @param int $size The size of the snapshot.
     */
    public function __construct(
        public string $backupId,
        public string $backupTime,
        public string $ctime,
        public int $size,
    ) {
    }
}
