<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class TaskStatus
{
    /**
     * @param int $pid Process ID
     * @param string $status Task status (running or stopped)
     */
    public function __construct(
        public int $pid,
        public string $status,
    ) {
    }
}
