<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\When;

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
