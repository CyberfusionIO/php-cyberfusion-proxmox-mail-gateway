<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class ReceiverDomainCreateRequest
{
    /**
     * @param string $domain DNS domain name (Sender).
     */
    public function __construct(
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
