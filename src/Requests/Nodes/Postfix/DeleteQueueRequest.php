<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix;

class DeleteQueueRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $queue Postfix queue name.
     */
    public function __construct(
        public string $node,
        public string $queue,
    ) {
    }
}
