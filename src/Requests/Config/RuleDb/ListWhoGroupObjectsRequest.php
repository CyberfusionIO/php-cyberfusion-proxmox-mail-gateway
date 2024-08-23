<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb;

class ListWhoGroupObjectsRequest
{
    /**
     * @param int $ogroup Object Group ID.
     */
    public function __construct(
        public int $ogroup,
    ) {
    }
}
