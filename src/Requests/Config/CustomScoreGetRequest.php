<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class CustomScoreGetRequest
{
    /**
     * @param string $name The name of the rule.
     */
    public function __construct(
        public string $name,
    ) {
    }
}
