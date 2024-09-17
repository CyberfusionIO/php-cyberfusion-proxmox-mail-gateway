<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Request class for fetching early SMTP reject count statistics.
 */
class RejectCountRequest
{
    /**
     * @param int|null $day Day of month. Get statistics for a single day. (1-31)
     * @param int|null $endtime Only consider entries older than 'endtime' (unix epoch). This is set to '<start> + 1day' by default.
     * @param int|null $month Month. You will get statistics for the whole month if you do not specify a day. (1-12)
     * @param int|null $starttime Only consider entries newer than 'starttime' (unix epoch). Default is 'now - 1day'.
     * @param int $timespan Return RBL/PREGREET rejects/<timespan>, where <timespan> is specified in seconds. (3600-31622400)
     * @param int|null $year Year. Defaults to current year. You will get statistics for the whole year if you do not specify a month or day. (1900-3000)
     */
    public function __construct(
        public ?int $day = null,
        public ?int $endtime = null,
        public ?int $month = null,
        public ?int $starttime = null,
        public int  $timespan = 3600,
        public ?int $year = null,
    ) {
    }
}
