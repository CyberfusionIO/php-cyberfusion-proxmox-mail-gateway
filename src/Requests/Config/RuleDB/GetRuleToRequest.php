<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class GetRuleToRequest
{
    /**
     * @param int $id Rule ID.
     */
    public function __construct(
        public int $id,
    ) {
    }
}