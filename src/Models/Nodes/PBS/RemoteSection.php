<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes\PBS;

class RemoteSection
{
    /**
     * @param string $section The section name.
     */
    public function __construct(
        public string $section,
    ) {
    }
}
