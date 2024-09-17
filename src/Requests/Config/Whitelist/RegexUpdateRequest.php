<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class RegexUpdateRequest
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
