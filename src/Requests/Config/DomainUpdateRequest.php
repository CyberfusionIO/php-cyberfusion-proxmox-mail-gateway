<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class DomainUpdateRequest
{
    /**
     * @param string $domain Domain name.
     * @param string $comment Comment.
     */
    public function __construct(
        public string $domain,
        public string $comment,
    ) {
    }
}
