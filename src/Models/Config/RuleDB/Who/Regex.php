<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Who;

class Regex
{
    /**
     * @param int $id Object ID.
     * @param string $regex Email address regular expression.
     */
    public function __construct(
        public int $id,
        public string $regex,
    ) {
    }
}
