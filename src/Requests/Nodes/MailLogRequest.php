<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class MailLogRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $id Mail ID (as returned by the list API).
     * @param int|null $endtime Only consider entries older than 'endtime' (unix epoch). This is set to '<start> + 1day' by default.
     * @param int|null $starttime Only consider entries newer than 'starttime' (unix epoch). Default is 'now - 1day'.
     */
    public function __construct(
        public string $node,
        public string $id,
        public ?int $endtime = null,
        public ?int $starttime = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'endtime' => $this->endtime,
            'starttime' => $this->starttime,
        ], fn($value) => !is_null($value));
    }
}
