<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class QuarantineWhitelistGetRequest
{
    /**
     * @param string|null $pmail List entries for the user with this primary email address.
     */
    public function __construct(
        public ?string $pmail = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'pmail' => $this->pmail,
        ], fn($value) => $value !== null);
    }
}
