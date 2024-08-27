<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimDomainDeleteRequest
{
    /**
     * @param string $domain Domain name.
     */
    public function __construct(
        public string $domain,
    ) {
    }
}
