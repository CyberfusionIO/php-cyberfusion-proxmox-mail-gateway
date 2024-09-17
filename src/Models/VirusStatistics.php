<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class VirusStatistics
{
    /**
     * @param int $count Detection count.
     * @param string $name Virus name.
     */
    public function __construct(
        public int    $count,
        public string $name,
    ) {
    }
}
