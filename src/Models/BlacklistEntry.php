<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Class BlacklistEntry
 *
 * This class represents a blacklist entry from the Proxmox Mail Gateway.
 */
class BlacklistEntry
{
    /**
     * @param string $address The blacklisted email address.
     */
    public function __construct(
        public string $address,
    ) {
    }
}
