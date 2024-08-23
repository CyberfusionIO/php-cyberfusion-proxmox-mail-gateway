<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class RuleConfigGetRequest
{
    /**
     * @param int $id Rule ID.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
