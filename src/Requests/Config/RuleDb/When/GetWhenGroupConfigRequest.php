<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\When;

class GetWhenGroupConfigRequest
{
    /**
     * @param int $ogroup Object Group ID.
     */
    public function __construct(
        public int $ogroup,
    ) {
    }
}
