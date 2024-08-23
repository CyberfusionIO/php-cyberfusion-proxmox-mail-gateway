<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When;

class ListWhenGroupObjectsRequest
{
    /**
     * @param int $ogroup Object Group ID.
     */
    public function __construct(
        public int $ogroup,
    ) {
    }
}
