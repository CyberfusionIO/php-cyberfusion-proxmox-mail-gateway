<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\What;

class ContentTypeCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $contenttype Content Type
     */
    public function __construct(
        public int $ogroup,
        public string $contenttype,
    ) {
    }
}
