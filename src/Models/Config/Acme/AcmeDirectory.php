<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Acme;

/**
 * Class AcmeDirectory
 *
 * Model representing an ACME directory endpoint.
 */
class AcmeDirectory
{
    /**
     * @param string $name The name of the ACME directory.
     * @param string $url URL of ACME CA directory endpoint.
     */
    public function __construct(
        public string $name,
        public string $url,
    ) {
    }
}
