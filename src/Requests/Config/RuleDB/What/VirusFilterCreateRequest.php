<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What;

class VirusFilterCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     */
    public function __construct(
        public int $ogroup,
    ) {
    }
}
