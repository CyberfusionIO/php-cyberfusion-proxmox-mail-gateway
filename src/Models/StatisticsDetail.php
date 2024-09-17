<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class StatisticsDetail
{
    public function __construct(
        public bool    $blocked,
        public int     $bytes,
        public float   $spamlevel,
        public int     $time,
        public ?string $receiver = null,
        public ?string $sender = null,
        public ?string $virusinfo = null,
    ) {
    }
}
