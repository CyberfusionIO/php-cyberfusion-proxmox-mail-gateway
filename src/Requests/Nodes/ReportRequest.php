<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

/**
 * Class ReportRequest
 *
 * This class represents a request to gather system information about a node.
 */
class ReportRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
