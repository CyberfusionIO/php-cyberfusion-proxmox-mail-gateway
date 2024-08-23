<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class SpamFilterCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $spamlevel Spam Level (minimum: 0)
     */
    public function __construct(
        public int $ogroup,
        public int $spamlevel,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'spamlevel' => $this->spamlevel,
        ];
    }
}
