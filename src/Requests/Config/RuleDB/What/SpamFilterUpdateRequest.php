<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What;

class SpamFilterUpdateRequest
{
    /**
     * @param int $id Object ID.
     * @param int $ogroup Object Groups ID.
     * @param int $spamlevel Spam Level (0 - N)
     */
    public function __construct(
        public int $id,
        public int $ogroup,
        public int $spamlevel,
    ) {
    }
}
