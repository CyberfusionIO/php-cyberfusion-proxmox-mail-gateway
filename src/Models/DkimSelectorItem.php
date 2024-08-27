<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class DkimSelectorItem
{
    /**
     * @param string $selector DKIM Selector
     */
    public function __construct(
        public string $selector,
    ) {
    }
}
