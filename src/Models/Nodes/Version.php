<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class Version
{
    /**
     * @param array $properties Package properties
     */
    public function __construct(
        public array $properties = [],
    ) {
    }
}
