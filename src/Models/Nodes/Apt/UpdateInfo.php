<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes\Apt;

class UpdateInfo
{
    /**
     * @param array $properties The properties of the update.
     */
    public function __construct(
        public array $properties,
    ) {
    }
}
