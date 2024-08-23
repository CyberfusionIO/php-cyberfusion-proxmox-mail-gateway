<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimDeleteRequest
{
    public function __construct(
        public string $domain,
    ) {
    }
}
