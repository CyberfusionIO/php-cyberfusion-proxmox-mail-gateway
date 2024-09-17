<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class TaskLog
{
    /**
     * @param int $n Line number
     * @param string $t Line text
     */
    public function __construct(
        public int $n,
        public string $t,
    ) {
    }
}
