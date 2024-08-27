<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Acme;

class AcmePluginGetRequest
{
    /**
     * @param string $id Unique identifier for ACME plugin instance.
     */
    public function __construct(
        public string $id,
    ) {
    }
}
