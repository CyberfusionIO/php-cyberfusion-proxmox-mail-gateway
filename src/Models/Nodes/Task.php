<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class Task
{
    /**
     * @param array $properties Task properties
     */
    public function __construct(
        public array $properties,
    ) {
    }
}
