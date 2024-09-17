<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Acme;

class AcmeAccountGetRequest
{
    /**
     * @param string $name ACME account config file name.
     */
    public function __construct(
        public string $name,
    ) {
    }
}
