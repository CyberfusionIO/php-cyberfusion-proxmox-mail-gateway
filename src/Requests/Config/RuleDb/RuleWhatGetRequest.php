<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb;

class RuleWhatGetRequest
{
    /**
     * @param int $id Rule ID.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
