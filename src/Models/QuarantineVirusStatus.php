<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class QuarantineVirusStatus
{
    /**
     * @param float $avgbytes Average size of stored mails in bytes.
     * @param int $count Number of stored mails.
     * @param float $mbytes Estimated disk space usage in MByte.
     */
    public function __construct(
        public float $avgbytes,
        public int $count,
        public float $mbytes,
    ) {
    }
}
