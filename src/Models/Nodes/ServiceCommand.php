<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class ServiceCommand
{
    /**
     * @param string $subdir The subdirectory of the command.
     */
    public function __construct(
        public string $subdir,
    ) {
    }
}
