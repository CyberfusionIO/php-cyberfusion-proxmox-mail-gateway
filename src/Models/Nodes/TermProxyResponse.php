<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class TermProxyResponse
{
    /**
     * @param int $port
     * @param string $ticket
     * @param string $upid
     * @param string $user
     */
    public function __construct(
        public int $port,
        public string $ticket,
        public string $upid,
        public string $user,
    ) {
    }
}
