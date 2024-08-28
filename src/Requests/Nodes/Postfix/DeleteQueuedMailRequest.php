<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix;

class DeleteQueuedMailRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $queue Postfix queue name.
     * @param string $queue_id The Message queue ID.
     */
    public function __construct(
        public string $node,
        public string $queue,
        public string $queue_id,
    ) {
    }
}
