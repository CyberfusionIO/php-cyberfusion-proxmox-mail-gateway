<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class MyNetworkUpdateRequest
{
    /**
     * @param string $cidr IPv4 or IPv6 network in CIDR notation.
     * @param string $comment Comment.
     */
    public function __construct(
        public string $cidr,
        public string $comment,
    ) {
    }
}
