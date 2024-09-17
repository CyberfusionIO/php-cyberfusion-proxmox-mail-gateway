<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB;

class FromGroup
{
    /**
     * @param int $id The ID of the group.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
