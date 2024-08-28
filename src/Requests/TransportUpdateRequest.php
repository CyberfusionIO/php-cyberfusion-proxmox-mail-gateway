<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class TransportUpdateRequest
{
    /**
     * @param string $domain Domain name.
     * @param string|null $host Target host (name or IP address).
     * @param string|null $comment Comment.
     * @param int|null $port Transport port.
     * @param string|null $protocol Transport protocol.
     * @param bool|null $use_mx Enable MX lookups (SMTP).
     */
    public function __construct(
        public string $domain,
        public ?string $host = null,
        public ?string $comment = null,
        public ?int $port = null,
        public ?string $protocol = null,
        public ?bool $use_mx = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'host' => $this->host,
            'comment' => $this->comment,
            'port' => $this->port,
            'protocol' => $this->protocol,
            'use_mx' => $this->use_mx,
        ], fn($value) => !is_null($value));
    }
}
