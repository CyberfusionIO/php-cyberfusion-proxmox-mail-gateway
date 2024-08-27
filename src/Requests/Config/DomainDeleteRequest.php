<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class DomainDeleteRequest
{
    /**
     * @param string $domain Domain name.
     */
    public function __construct(
        public string $domain,
    ) {
    }
}
