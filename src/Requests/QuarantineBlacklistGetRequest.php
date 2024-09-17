<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class QuarantineBlacklistGetRequest
 *
 * This class represents a request to get the user blacklist from the Proxmox Mail Gateway.
 */
class QuarantineBlacklistGetRequest
{
    /**
     * @param string|null $pmail List entries for the user with this primary email address. Quarantine users cannot specify this parameter, but it is required for all other roles.
     */
    public function __construct(
        public ?string $pmail = null,
    ) {
    }

    /**
     * Convert the request parameters to an array.
     *
     * @return array An array of non-null parameters.
     */
    public function toArray(): array
    {
        return array_filter([
            'pmail' => $this->pmail,
        ], fn($value) => $value !== null);
    }
}
