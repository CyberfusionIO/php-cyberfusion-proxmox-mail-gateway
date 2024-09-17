<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class DomainUpdateRequest
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

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'domain' => $this->domain,
        ];
    }
}
