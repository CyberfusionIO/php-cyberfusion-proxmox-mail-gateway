<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Acme;

class AcmeAccountUpdateRequest
{
    /**
     * @param string $name ACME account config file name.
     * @param string|null $contact Contact email addresses.
     */
    public function __construct(
        public string $name,
        public ?string $contact = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'contact' => $this->contact,
        ], fn($value) => !is_null($value));
    }
}
