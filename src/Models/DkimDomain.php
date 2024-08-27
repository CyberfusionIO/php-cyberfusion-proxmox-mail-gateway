<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class DkimDomain
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
