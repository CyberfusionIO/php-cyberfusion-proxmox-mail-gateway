<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Action;

class ActionObject
{
    /**
     * @param string $id Action Object ID.
     */
    public function __construct(
        public string $id,
    ) {
    }
}
