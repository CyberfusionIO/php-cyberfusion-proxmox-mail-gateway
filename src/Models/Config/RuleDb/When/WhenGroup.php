<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\When;

class WhenGroup
{
    /**
     * @param int $id The unique identifier of the 'when' group.
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
