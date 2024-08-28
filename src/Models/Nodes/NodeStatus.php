<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class NodeStatus
{
    /**
     * @param array $bootInfo Meta-information about the boot mode.
     * @param array $currentKernel Meta-information about the currently booted kernel.
     * @param bool $insync Database is synced with other nodes.
     * @param int $time Seconds since 1970-01-01 00:00:00 UTC.
     * @param int $uptime The uptime of the system in seconds.
     */
    public function __construct(
        public array $bootInfo,
        public array $currentKernel,
        public bool $insync,
        public int $time,
        public int $uptime,
    ) {
    }
}
