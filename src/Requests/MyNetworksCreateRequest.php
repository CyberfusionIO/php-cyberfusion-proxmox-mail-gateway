<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class MyNetworksCreateRequest
{
    /**
     * @param string $cidr IPv4 or IPv6 network in CIDR notation.
     * @param string|null $comment Comment.
     */
    public function __construct(
        public string $cidr,
        public ?string $comment = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'cidr' => $this->cidr,
            'comment' => $this->comment,
        ], fn($value) => !is_null($value));
    }
}
