<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What;

class DeleteObjectRequest
{
    /**
     * @param int $ogroup Object Group ID.
     * @param int $id Object ID.
     */
    public function __construct(
        public int $ogroup,
        public int $id,
    ) {
    }
}
