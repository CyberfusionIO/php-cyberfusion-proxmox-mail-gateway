<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class DomainGetRequest
{
    /**
     * @param string $domain Domain name.
     */
    public function __construct(
        public string $domain,
    ) {
    }
}
