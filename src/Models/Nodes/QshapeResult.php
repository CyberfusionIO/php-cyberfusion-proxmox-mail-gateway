<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class QshapeResult
{
    /**
     * @param array $attributes The qshape result attributes.
     */
    public function __construct(
        public array $attributes,
    ) {
    }
}
