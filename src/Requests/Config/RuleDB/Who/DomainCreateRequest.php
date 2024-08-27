<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class DomainCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $domain DNS domain name (Sender).
     */
    public function __construct(
        public int $ogroup,
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
