<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\Action;

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
