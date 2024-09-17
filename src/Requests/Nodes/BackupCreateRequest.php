<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class BackupCreateRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string|null $notify Specify when to notify via e-mail. Can be 'always', 'error', or 'never'.
     * @param bool|null $statistic Backup statistic databases.
     */
    public function __construct(
        public string $node,
        public ?string $notify = null,
        public ?bool $statistic = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'notify' => $this->notify,
            'statistic' => $this->statistic,
        ], fn($value) => !is_null($value));
    }
}
