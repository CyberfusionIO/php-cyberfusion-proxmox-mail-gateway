<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class BccGetRequest
{
    /**
     * @param string $id Action Object ID.
     */
    public function __construct(
        public string $id,
    ) {
    }
}
