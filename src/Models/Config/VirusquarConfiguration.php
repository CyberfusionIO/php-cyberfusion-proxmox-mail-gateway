<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config;

class VirusquarConfiguration
{
    /**
     * @param bool|null $allowhrefs Allow to view hyperlinks.
     * @param int|null $lifetime Quarantine life time (days)
     * @param bool|null $viewimages Allow to view images.
     */
    public function __construct(
        public ?bool $allowhrefs = null,
        public ?int $lifetime = null,
        public ?bool $viewimages = null,
    ) {
    }
}
