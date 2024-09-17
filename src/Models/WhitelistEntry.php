<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class WhitelistEntry
{
    /**
     * @param string $address The whitelisted email address.
     */
    public function __construct(
        public string $address,
    ) {
    }
}
