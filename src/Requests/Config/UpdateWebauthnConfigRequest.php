<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class UpdateWebauthnConfigRequest
{
    /**
     * @param bool|null $allowSubdomains Whether to allow the origin to be a subdomain, rather than the exact URL.
     * @param string|null $delete A list of settings you want to delete.
     * @param string|null $digest Prevent changes if current configuration file has different SHA1 digest. This can be used to prevent concurrent modifications.
     * @param string|null $id Relying part ID. Must be the domain name without protocol, port or location.
     *                        Changing this *will* break existing credentials.
     * @param string|null $origin Site origin. Must be a `https://` URL (or `http://localhost`). Should contain the address users type in their browsers to access the web interface.
     *                            Changing this *may* break existing credentials.
     * @param string|null $rp Relying party name. Any text identifier.
     *                        Changing this *may* break existing credentials.
     */
    public function __construct(
        public ?bool $allowSubdomains = null,
        public ?string $delete = null,
        public ?string $digest = null,
        public ?string $id = null,
        public ?string $origin = null,
        public ?string $rp = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'allow-subdomains' => $this->allowSubdomains,
            'delete' => $this->delete,
            'digest' => $this->digest,
            'id' => $this->id,
            'origin' => $this->origin,
            'rp' => $this->rp,
        ], fn($value) => !is_null($value));
    }
}
