<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class RegexCreateRequest
{
    /**
     * @param string $regex Email address regular expression.
     */
    public function __construct(
        public string $regex,
    ) {
    }
}
