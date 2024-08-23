<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\What;

class FilenameFilter
{
    /**
     * @param int $id The object ID.
     * @param string $filename Filename filter
     */
    public function __construct(
        public int $id,
        public string $filename,
    ) {
    }
}
