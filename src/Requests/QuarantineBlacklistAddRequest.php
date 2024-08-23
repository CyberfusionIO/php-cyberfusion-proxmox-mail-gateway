<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class QuarantineBlacklistAddRequest
 *
 * This class represents a request to add entries to the user blacklist in the Proxmox Mail Gateway.
 */
class QuarantineBlacklistAddRequest
{
    /**
     * @param string $address The address you want to add.
     * @param string|null $pmail List entries for the user with this primary email address. Quarantine users cannot specify this parameter, but it is required for all other roles.
     */
    public function __construct(
        public string $address,
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
            'address' => $this->address,
            'pmail' => $this->pmail,
        ], fn($value) => $value !== null);
    }
}
