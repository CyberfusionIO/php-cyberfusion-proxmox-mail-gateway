<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Acme;

class AcmeAccountInfo
{
    /**
     * @param array|null $account
     * @param string|null $directory URL of ACME CA directory endpoint.
     * @param string|null $location
     * @param string|null $tos
     */
    public function __construct(
        public ?array $account,
        public ?string $directory,
        public ?string $location,
        public ?string $tos,
    ) {
    }
}
