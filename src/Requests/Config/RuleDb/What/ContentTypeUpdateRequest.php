<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\What;

class ContentTypeUpdateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $id Object ID.
     * @param string $contenttype Content Type
     */
    public function __construct(
        public int $ogroup,
        public int $id,
        public string $contenttype,
    ) {
    }
}
