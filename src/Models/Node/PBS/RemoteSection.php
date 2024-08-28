<?php

namespace Cyberfusion\ProxmoxMGW\Models\Node\PBS;

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
