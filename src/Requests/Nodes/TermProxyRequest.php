<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class TermProxyRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string|null $cmd Run specific command or default to login.
     * @param string|null $cmdOpts Add parameters to a command. Encoded as null terminated strings.
     */
    public function __construct(
        public string $node,
        public ?string $cmd = null,
        public ?string $cmdOpts = null,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'cmd' => $this->cmd,
            'cmd-opts' => $this->cmdOpts,
        ], fn($value) => $value !== null);
    }
}
