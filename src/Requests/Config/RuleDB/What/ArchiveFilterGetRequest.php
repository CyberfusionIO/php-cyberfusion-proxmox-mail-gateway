<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What;

class ArchiveFilterGetRequest
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
