<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class FetchmailGetRequest
{
    /**
     * @param string $id Unique ID
     */
    public function __construct(
        public string $id,
    ) {
    }
}
