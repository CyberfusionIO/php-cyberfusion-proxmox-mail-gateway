<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class CreateArchiveFilenameFilterRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $filename Filename filter
     */
    public function __construct(
        public int $ogroup,
        public string $filename,
    ) {
    }
}
