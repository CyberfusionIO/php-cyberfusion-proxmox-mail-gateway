<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config;

class Domain
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
}
