<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing early SMTP reject count statistics.
 */
class RejectCountStatistics
{
    /**
     * @param int $index Time index.
     * @param int $pregreet_rejects PREGREET reject count.
     * @param int $rbl_rejects RBL reject count.
     * @param int $time Time (Unix epoch).
     */
    public function __construct(
        public int $index,
        public int $pregreet_rejects,
        public int $rbl_rejects,
        public int $time,
    ) {
    }
}
