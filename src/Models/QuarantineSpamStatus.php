<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class QuarantineSpamStatus
{
    public function __construct(
        public float $avgbytes,
        public float $avgspam,
        public int $count,
        public float $mbytes,
    ) {
    }
}
