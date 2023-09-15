<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimCreateRequest
{
    public function __construct(
        public string $domain,
        public string $comment = '',
    ) {
    }
}
