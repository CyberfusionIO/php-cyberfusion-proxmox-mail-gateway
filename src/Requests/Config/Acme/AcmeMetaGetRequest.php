<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Acme;

/**
 * Class AcmeMetaGetRequest
 *
 * Request class for retrieving ACME Directory Meta Information.
 */
class AcmeMetaGetRequest
{
    /**
     * @param string|null $directory URL of ACME CA directory endpoint.
     */
    public function __construct(
        public ?string $directory = 'https://acme-v02.api.letsencrypt.org/directory',
    ) {
    }

    /**
     * Convert the request to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'directory' => $this->directory,
        ];
    }
}
