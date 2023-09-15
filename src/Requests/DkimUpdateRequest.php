<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimUpdateRequest
{
    public function __construct(
        public string $domain,
        public string $comment = '',
    ) {
    }
}
