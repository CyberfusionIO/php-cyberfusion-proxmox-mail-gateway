<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Class RuledbDigest
 *
 * Represents the rule database digest in the Proxmox Mail Gateway.
 */
class RuledbDigest
{
    /**
     * @param string $digest The rule database digest.
     */
    public function __construct(
        public string $digest,
    ) {
    }
}
