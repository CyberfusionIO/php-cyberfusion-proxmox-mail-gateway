<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb;

class GetWhoGroupConfigRequest
{
    /**
     * @param int $ogroup Object Group ID.
     */
    public function __construct(
        public int $ogroup,
    ) {
    }
}
