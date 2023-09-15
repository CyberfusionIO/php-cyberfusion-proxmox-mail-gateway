<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class DkimGetRequest
{
    public function __construct(
        public string $domain
    ) {
    }
}
