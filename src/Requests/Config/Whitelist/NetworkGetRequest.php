<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class NetworkGetRequest
{
    /**
     * @param int $id Object ID.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
