<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class DomainUpdateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $id Object ID.
     * @param string $domain DNS domain name (Sender).
     */
    public function __construct(
        public int $ogroup,
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
