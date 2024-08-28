<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class ClamavDatabaseStatus
{
    /**
     * @param string $build_time
     * @param int $nsigs
     * @param string $type
     * @param string|null $version
     */
    public function __construct(
        public string $build_time,
        public int $nsigs,
        public string $type,
        public ?string $version = null,
    ) {
    }
}
