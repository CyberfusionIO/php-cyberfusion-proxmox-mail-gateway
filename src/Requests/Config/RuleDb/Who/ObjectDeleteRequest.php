<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who;

class ObjectDeleteRequest
{
    /**
     * @param int $id Object ID.
     * @param int $ogroup Object Group ID.
     */
    public function __construct(
        public int $id,
        public int $ogroup,
    ) {
    }
}
