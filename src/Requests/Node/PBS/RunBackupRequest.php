<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Node\PBS;

class RunBackupRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $remote Proxmox Backup Server ID.
     * @param string|null $notify Specify when to notify via e-mail.
     * @param bool|null $statistic Backup statistic databases.
     */
    public function __construct(
        public string $node,
        public string $remote,
        public ?string $notify = null,
        public ?bool $statistic = null,
    ) {
    }

    /**
     * Convert the request parameters to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'notify' => $this->notify,
            'statistic' => $this->statistic,
        ], fn($value) => !is_null($value));
    }
}
