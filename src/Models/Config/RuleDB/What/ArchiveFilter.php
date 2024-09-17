<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\What;

class ArchiveFilter
{
    /**
     * @param int $id Object ID.
     * @param string|null $contenttype Content Type (max length: 1024, pattern: [0-9a-zA-Z\/\\[]+\-\.\*\_]+)
     */
    public function __construct(
        public int $id,
        public ?string $contenttype = null,
    ) {
    }
}
