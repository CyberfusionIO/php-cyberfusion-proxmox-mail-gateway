<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class TransportMap
{
    /**
     * @param string|null $comment Comment.
     * @param string $domain Domain name.
     * @param string $host Target host (name or IP address).
     * @param int $port Transport port.
     * @param string $protocol Transport protocol.
     * @param bool $use_mx Enable MX lookups (SMTP).
     */
    public function __construct(
        public ?string $comment,
        public string $domain,
        public string $host,
        public int $port,
        public string $protocol,
        public bool $use_mx,
    ) {
    }
}
