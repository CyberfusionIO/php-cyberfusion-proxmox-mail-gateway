<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Request class for fetching receiver address statistics.
 */
class ReceiverRequest
{
    /**
     * @param int|null $day Day of month. Get statistics for a single day. (1-31)
     * @param int|null $endtime Only consider entries older than 'endtime' (unix epoch). This is set to '<start> + 1day' by default.
     * @param string|null $filter Receiver address filter.
     * @param int|null $month Month. You will get statistics for the whole month if you do not specify a day. (1-12)
     * @param string|null $orderby Remote sorting configuration(JSON, ExtJS compatible).
     * @param int|null $starttime Only consider entries newer than 'starttime' (unix epoch). Default is 'now - 1day'.
     * @param int|null $year Year. Defaults to current year. You will get statistics for the whole year if you do not specify a month or day. (1900-3000)
     */
    public function __construct(
        public ?int    $day = null,
        public ?int    $endtime = null,
        public ?string $filter = null,
        public ?int    $month = null,
        public ?string $orderby = null,
        public ?int    $starttime = null,
        public ?int    $year = null,
    ) {
    }
}
