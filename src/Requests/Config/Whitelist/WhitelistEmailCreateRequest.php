<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class WhitelistEmailCreateRequest
{
    /**
     * @param string $email Email address.
     */
    public function __construct(
        public string $email,
    ) {
    }
}
