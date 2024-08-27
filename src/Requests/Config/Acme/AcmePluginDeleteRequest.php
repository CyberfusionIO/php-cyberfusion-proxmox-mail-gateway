<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Acme;

class AcmePluginDeleteRequest
{
    /**
     * @param string $id Unique identifier for ACME plugin instance.
     */
    public function __construct(
        public string $id,
    ) {
    }
}
