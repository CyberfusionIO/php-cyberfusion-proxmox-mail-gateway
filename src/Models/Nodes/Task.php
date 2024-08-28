<?php

namespace Cyberfusion\ProxmoxPVE\Models\Nodes;

class Task
{
    /**
     * @param string $upid Unique task ID.
     */
    public function __construct(
        public string $upid,
    ) {
    }
}
