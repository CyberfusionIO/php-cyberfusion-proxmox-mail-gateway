<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Ruledb;

class GetActionRequest
{
    /**
     * @param int $id Rule ID.
     */
    public function __construct(
        public int $id,
    ) {
    }
}
