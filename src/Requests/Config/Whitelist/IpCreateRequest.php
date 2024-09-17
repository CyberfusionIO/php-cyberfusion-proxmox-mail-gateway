<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class IpCreateRequest
{
    /**
     * @param string $ip IP address
     */
    public function __construct(
        public string $ip,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'ip' => $this->ip,
        ];
    }
}
