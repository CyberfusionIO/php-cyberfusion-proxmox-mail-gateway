<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDb;

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