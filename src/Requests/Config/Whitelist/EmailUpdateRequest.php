<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class EmailUpdateRequest
{
    /**
     * @param int $id Object ID.
     * @param string $email Email address.
     */
    public function __construct(
        public int $id,
        public string $email,
    ) {
    }
}
