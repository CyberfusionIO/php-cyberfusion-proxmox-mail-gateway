<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When;

class TimeframeCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $start Start time in `H:i` format (00:00).
     * @param string $end End time in `H:i` format (00:00).
     */
    public function __construct(
        public int $ogroup,
        public string $start,
        public string $end,
    ) {
    }
}
