<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

class StatisticsDetailRequest
{
    public function __construct(
        public string  $address,
        public string  $type,
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
