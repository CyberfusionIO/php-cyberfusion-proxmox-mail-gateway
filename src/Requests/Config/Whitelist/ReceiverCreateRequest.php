<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class ReceiverCreateRequest
{
    /**
     * @param string $email Email address.
     */
    public function __construct(
        public string $email,
    ) {
    }
}
