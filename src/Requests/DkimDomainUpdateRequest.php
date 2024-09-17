<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimDomainUpdateRequest
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
