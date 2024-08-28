<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes\Pbs;

class Timer
{
    /**
     * @param string|null $delay Randomized delay to add to the starttime (RandomizedDelaySec setting of the systemd.timer)
     * @param string|null $nextRun The date time of the next run, in server locale.
     * @param string|null $remote Proxmox Backup Server remote ID.
     * @param string|null $schedule Schedule for the backup (OnCalendar setting of the systemd.timer)
     * @param string|null $unitfile unit file for the systemd.timer unit
     */
    public function __construct(
        public ?string $delay = null,
        public ?string $nextRun = null,
        public ?string $remote = null,
        public ?string $schedule = null,
        public ?string $unitfile = null,
    ) {
    }
}
