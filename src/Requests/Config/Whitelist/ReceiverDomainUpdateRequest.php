<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class ReceiverDomainUpdateRequest
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
