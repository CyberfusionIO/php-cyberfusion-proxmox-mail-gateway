<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class GetTaskRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $upid The task UPID.
     */
    public function __construct(
        public string $node,
        public string $upid,
    ) {
    }
}
