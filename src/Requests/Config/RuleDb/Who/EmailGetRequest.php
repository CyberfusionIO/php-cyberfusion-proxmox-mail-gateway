<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who;

class EmailGetRequest
{
    /**
     * @param int $id Object ID.
     * @param int $ogroup Object Groups ID.
     */
    public function __construct(
        public int $id,
        public int $ogroup,
    ) {
    }
}
