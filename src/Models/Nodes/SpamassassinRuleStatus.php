<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class SpamassassinRuleStatus
{
    /**
     * @param string $channel
     * @param int|null $last_updated
     * @param bool $update_avail
     * @param string|null $update_version
     * @param string|null $version
     */
    public function __construct(
        public string $channel,
        public ?int $last_updated,
        public bool $update_avail,
        public ?string $update_version,
        public ?string $version,
    ) {
    }
}
