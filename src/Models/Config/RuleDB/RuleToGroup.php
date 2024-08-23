<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB;

class RuleToGroup
{
    /**
     * @param int $id The ID of the group.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
