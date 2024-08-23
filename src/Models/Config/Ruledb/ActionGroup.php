<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Ruledb;

class ActionGroup
{
    /**
     * @param int $id The ID of the action group.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
