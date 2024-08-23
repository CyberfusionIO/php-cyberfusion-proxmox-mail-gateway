<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDb;

class WhoGroup
{
    /**
     * @param int $id The group ID.
     * @param string|null $info Informational comment.
     * @param string|null $name Group name.
     */
    public function __construct(
        public int $id,
        public ?string $info = null,
        public ?string $name = null,
    ) {
    }
}