<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\Whitelist;

class ReceiverRegex
{
    /**
     * @param int $id Object ID.
     * @param string $regex Email address regular expression.
     */
    public function __construct(
        public int $id,
        public string $regex,
    ) {
    }
}
