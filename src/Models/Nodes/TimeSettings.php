<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class TimeSettings
{
    /**
     * @param int $localtime Seconds since 1970-01-01 00:00:00 (local time)
     * @param int $time Seconds since 1970-01-01 00:00:00 UTC.
     * @param string $timezone Time zone
     */
    public function __construct(
        public int $localtime,
        public int $time,
        public string $timezone,
    ) {
    }
}
