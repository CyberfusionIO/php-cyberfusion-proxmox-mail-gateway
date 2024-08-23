<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDb;

class RuleConfig
{
    /**
     * @param bool $active Whether the rule is active.
     * @param int $direction Rule direction.
     * @param int $id Rule ID.
     * @param string $name Rule name.
     * @param int $priority Rule priority.
     */
    public function __construct(
        public bool $active,
        public int $direction,
        public int $id,
        public string $name,
        public int $priority,
    ) {
    }
}
