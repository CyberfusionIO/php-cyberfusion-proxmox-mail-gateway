<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class BackupDeleteRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $filename The backup file name.
     */
    public function __construct(
        public string $node,
        public string $filename,
    ) {
    }
}