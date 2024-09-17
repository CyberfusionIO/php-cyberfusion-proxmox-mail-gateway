<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class QuarantineWhitelistAddRequest
{
    /**
     * @param string $address The address you want to add.
     * @param string|null $pmail List entries for the user with this primary email address.
     */
    public function __construct(
        public string $address,
        public ?string $pmail = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'address' => $this->address,
            'pmail' => $this->pmail,
        ], fn($value) => $value !== null);
    }
}
