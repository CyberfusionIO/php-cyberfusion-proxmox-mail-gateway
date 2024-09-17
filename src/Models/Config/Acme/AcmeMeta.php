<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Acme;

/**
 * Class AcmeMeta
 *
 * Model representing ACME Directory Meta Information.
 */
class AcmeMeta
{
    /**
     * @param string[]|null $caaIdentities Hostnames referring to the ACME servers.
     * @param bool|null $externalAccountRequired EAB Required.
     * @param string|null $termsOfService ACME TermsOfService URL.
     * @param string|null $website URL to more information about the ACME server.
     */
    public function __construct(
        public ?array $caaIdentities = null,
        public ?bool $externalAccountRequired = null,
        public ?string $termsOfService = null,
        public ?string $website = null,
    ) {
    }
}
