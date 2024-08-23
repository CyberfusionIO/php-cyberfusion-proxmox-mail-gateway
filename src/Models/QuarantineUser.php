<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Class QuarantineUser
 *
 * This class represents a user with whitelist/blacklist settings in the Proxmox Mail Gateway.
 */
class QuarantineUser
{
    /**
     * @param string $mail The receiving email
     */
    public function __construct(
        public string $mail,
    ) {
    }
}
