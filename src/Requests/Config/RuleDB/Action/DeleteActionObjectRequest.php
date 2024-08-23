<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class DeleteActionObjectRequest
{
    /**
     * @param string $id Action Object ID.
     */
    public function __construct(
        public string $id,
    ) {
    }
}
