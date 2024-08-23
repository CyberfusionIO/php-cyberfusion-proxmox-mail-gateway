<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\When;

class TimeframeUpdateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $id Object ID.
     * @param string $start Start time in `H:i` format (00:00).
     * @param string $end End time in `H:i` format (00:00).
     */
    public function __construct(
        public int $ogroup,
        public int $id,
        public string $start,
        public string $end,
    ) {
    }
}
