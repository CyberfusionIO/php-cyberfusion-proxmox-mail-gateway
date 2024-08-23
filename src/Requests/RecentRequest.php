<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Request class for fetching recent mail count statistics.
 */
class RecentRequest
{
    /**
     * @param int $hours How many hours you want to get (1-24)
     * @param int $timespan The Timespan for one datapoint (in seconds) (1-1800)
     */
    public function __construct(
        public int $hours = 12,
        public int $timespan = 1800,
    ) {
    }
}
