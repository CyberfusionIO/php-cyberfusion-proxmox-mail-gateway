<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class BackupRestoreRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $filename The backup file name.
     * @param bool|null $config Restore system configuration.
     * @param bool|null $database Restore the rule database. This is the default.
     * @param bool|null $statistic Restore statistic databases. Only considered when you restore the 'database'.
     */
    public function __construct(
        public string $node,
        public string $filename,
        public ?bool $config = null,
        public ?bool $database = null,
        public ?bool $statistic = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'config' => $this->config,
            'database' => $this->database,
            'statistic' => $this->statistic,
        ], fn($value) => !is_null($value));
    }
}
