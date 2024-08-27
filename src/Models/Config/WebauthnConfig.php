<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config;

class WebauthnConfig
{
    /**
     * @param bool|null $allowSubdomains Whether to allow the origin to be a subdomain, rather than the exact URL.
     * @param string|null $id Relying part ID. Must be the domain name without protocol, port or location.
     *                        Changing this *will* break existing credentials.
     * @param string|null $origin Site origin. Must be a `https://` URL (or `http://localhost`). Should contain the address users type in their browsers to access the web interface.
     *                            Changing this *may* break existing credentials.
     * @param string|null $rp Relying party name. Any text identifier.
     *                        Changing this *may* break existing credentials.
     */
    public function __construct(
        public ?bool $allowSubdomains = null,
        public ?string $id = null,
        public ?string $origin = null,
        public ?string $rp = null,
    ) {
    }
}
