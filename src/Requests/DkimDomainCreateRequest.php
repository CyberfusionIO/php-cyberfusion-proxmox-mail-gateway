<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimDomainCreateRequest
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

    /**
     * Convert the request to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'comment' => $this->comment,
        ]);
    }
}
