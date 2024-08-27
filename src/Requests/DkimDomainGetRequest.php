<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimDomainGetRequest
{
    /**
     * @param string $domain Domain name.
     */
    public function __construct(
        public string $domain,
    ) {
    }
}
