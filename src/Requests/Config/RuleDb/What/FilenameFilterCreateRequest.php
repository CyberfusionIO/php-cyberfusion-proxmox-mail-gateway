<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\What;

class FilenameFilterCreateRequest
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

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'filename' => $this->filename,
        ];
    }
}
