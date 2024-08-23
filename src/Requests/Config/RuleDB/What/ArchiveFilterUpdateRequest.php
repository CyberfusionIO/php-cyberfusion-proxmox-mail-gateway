<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What;

class ArchiveFilterUpdateRequest
{
    /**
     * @param string $contenttype Content Type (max length: 1024, pattern: [0-9a-zA-Z\/\\[]+\-\.\*\_]+)
     * @param int $id Object ID.
     * @param int $ogroup Object Groups ID.
     */
    public function __construct(
        public string $contenttype,
        public int $id,
        public int $ogroup,
    ) {
    }
}
