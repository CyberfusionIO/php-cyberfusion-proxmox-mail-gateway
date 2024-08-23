<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB;

class Rule
{
    /**
     * @param int $id The rule ID.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
