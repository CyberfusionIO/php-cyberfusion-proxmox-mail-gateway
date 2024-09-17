<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class VncWebSocketRequest
{
    /**
     * @param string $node The cluster node name.
     * @param int $port Port number returned by previous vncproxy call.
     * @param string $vncticket Ticket from previous call to vncproxy.
     */
    public function __construct(
        public string $node,
        public int $port,
        public string $vncticket,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'port' => $this->port,
            'vncticket' => $this->vncticket,
        ];
    }
}
