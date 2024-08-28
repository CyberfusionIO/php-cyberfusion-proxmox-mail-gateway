<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DomainCreateRequest
{
    /**
     * @param string $domain Domain name.
     * @param string|null $comment Comment.
     */
    public function __construct(
        public string $domain,
        public ?string $comment = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'comment' => $this->comment,
        ], fn($value) => $value !== null);
    }
}
