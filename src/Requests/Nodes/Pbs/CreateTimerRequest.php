<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Pbs;

class CreateTimerRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $remote Proxmox Backup Server ID.
     * @param string $delay Randomized delay to add to the starttime (RandomizedDelaySec setting of the systemd.timer)
     * @param string $schedule Schedule for the backup (OnCalendar setting of the systemd.timer)
     */
    public function __construct(
        public string $node,
        public string $remote,
        public string $delay = '5min',
        public string $schedule = 'daily',
    ) {
    }
}
