<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\What;

class SpamFilter
{
    /**
     * @param int $id Object ID.
     * @param int|null $spamlevel Spam Level (0 - N)
     */
    public function __construct(
        public int $id,
        public ?int $spamlevel = null,
    ) {
    }
}
