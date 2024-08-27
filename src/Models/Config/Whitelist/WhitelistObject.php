<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Whitelist;

class WhitelistObject
{
    /**
     * @param int $id The object ID.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
