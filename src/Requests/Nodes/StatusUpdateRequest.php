<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class StatusUpdateRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $command Specify the command (reboot or shutdown).
     */
    public function __construct(
        public string $node,
        public string $command,
    ) {
    }

    public function toArray(): array
    {
        return [
            'command' => $this->command,
        ];
    }
}
