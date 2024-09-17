<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class RegexUpdateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $id Object ID.
     * @param string $regex Email address regular expression.
     */
    public function __construct(
        public int $ogroup,
        public int $id,
        public string $regex,
    ) {
    }
}
