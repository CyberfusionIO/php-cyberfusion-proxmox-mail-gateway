<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Acme;

class AcmeAccountRegisterRequest
{
    /**
     * @param string $contact Contact email addresses.
     * @param string|null $directory URL of ACME CA directory endpoint.
     * @param string|null $eabHmacKey HMAC key for External Account Binding.
     * @param string|null $eabKid Key Identifier for External Account Binding.
     * @param string|null $name ACME account config file name.
     * @param string|null $tosUrl URL of CA TermsOfService - setting this indicates agreement.
     */
    public function __construct(
        public string $contact,
        public ?string $directory = null,
        public ?string $eabHmacKey = null,
        public ?string $eabKid = null,
        public ?string $name = null,
        public ?string $tosUrl = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'contact' => $this->contact,
            'directory' => $this->directory,
            'eab-hmac-key' => $this->eabHmacKey,
            'eab-kid' => $this->eabKid,
            'name' => $this->name,
            'tos_url' => $this->tosUrl,
        ], fn($value) => !is_null($value));
    }
}
