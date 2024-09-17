<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB;

class RuleWhatGroup
{
    /**
     * @param int $id The ID of the 'what' group.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
