<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB;

class MatchField
{
    /**
     * @param int $id Object ID.
     * @param string $field The Field
     * @param string $value The Value
     */
    public function __construct(
        public int $id,
        public string $field,
        public string $value,
    ) {
    }
}
