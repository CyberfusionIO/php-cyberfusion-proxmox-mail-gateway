<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Whitelist;

class Receiver
{
    /**
     * @param int $id Object ID.
     * @param string $email Email address.
     */
    public function __construct(
        public int $id,
        public string $email,
    ) {
    }
}
