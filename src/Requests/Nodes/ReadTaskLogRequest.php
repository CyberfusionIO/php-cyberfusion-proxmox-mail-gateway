<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class ReadTaskLogRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $upid The task UPID.
     * @param bool|null $download Whether the tasklog file should be downloaded. This parameter can't be used in conjunction with other parameters.
     * @param int|null $limit The amount of lines to read from the tasklog.
     * @param int|null $start Start at this line when reading the tasklog.
     */
    public function __construct(
        public string $node,
        public string $upid,
        public ?bool $download = null,
        public ?int $limit = null,
        public ?int $start = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'download' => $this->download,
            'limit' => $this->limit,
            'start' => $this->start,
        ], fn($value) => !is_null($value));
    }
}
