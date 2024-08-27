<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class Node
{
    /**
     * @param array $attributes The node attributes.
     */
    public function __construct(
        public array $attributes,
    ) {
    }
}
