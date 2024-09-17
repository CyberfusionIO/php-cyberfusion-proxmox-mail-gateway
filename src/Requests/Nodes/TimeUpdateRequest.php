<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class TimeUpdateRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $timezone Time zone. The file '/usr/share/zoneinfo/zone.tab' contains the list of valid names.
     */
    public function __construct(
        public string $node,
        public string $timezone,
    ) {
    }

    public function toArray(): array
    {
        return [
            'timezone' => $this->timezone,
        ];
    }
}
