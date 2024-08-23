<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb;

class AddRuleFromGroupRequest
{
    /**
     * @param int $id Rule ID.
     * @param int $ogroup Groups ID.
     */
    public function __construct(
        public int $id,
        public int $ogroup,
    ) {
    }
}
