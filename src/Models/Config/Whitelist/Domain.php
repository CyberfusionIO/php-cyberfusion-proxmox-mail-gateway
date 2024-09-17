<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Whitelist;

class Domain
{
    /**
     * @param int $id Object ID.
     * @param string $domain DNS domain name (Sender).
     */
    public function __construct(
        public int $id,
        public string $domain,
    ) {
    }
}
