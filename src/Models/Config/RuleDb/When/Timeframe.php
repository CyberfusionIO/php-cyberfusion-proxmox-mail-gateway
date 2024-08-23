<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\When;

class Timeframe
{
    /**
     * @param int $id Object ID.
     * @param string $start Start time in `H:i` format (00:00).
     * @param string $end End time in `H:i` format (00:00).
     */
    public function __construct(
        public int $id,
        public string $start,
        public string $end,
    ) {
    }
}
