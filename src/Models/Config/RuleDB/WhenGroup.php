<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB;

class WhenGroup
{
    /**
     * @param int $id The ID of the 'when' group.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
