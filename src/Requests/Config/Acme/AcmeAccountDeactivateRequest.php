<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Acme;

class AcmeAccountDeactivateRequest
{
    /**
     * @param string $name ACME account config file name.
     * @param bool|null $force Delete account data even if the server refuses to deactivate the account.
     */
    public function __construct(
        public string $name,
        public ?bool $force = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'force' => $this->force,
        ], fn($value) => !is_null($value));
    }
}
