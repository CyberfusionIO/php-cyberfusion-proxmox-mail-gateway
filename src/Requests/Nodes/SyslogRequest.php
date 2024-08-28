<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

/**
 * Class SyslogRequest
 *
 * This class represents a request to read the system log.
 */
class SyslogRequest
{
    /**
     * @param string $node The cluster node name.
     * @param int|null $limit Limit number of entries (0 - N).
     * @param string|null $service Service ID.
     * @param string|null $since Display all log since this date-time string.
     * @param int|null $start Start at entry (0 - N).
     * @param string|null $until Display all log until this date-time string.
     */
    public function __construct(
        public string $node,
        public ?int $limit = null,
        public ?string $service = null,
        public ?string $since = null,
        public ?int $start = null,
        public ?string $until = null,
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
            'limit' => $this->limit,
            'service' => $this->service,
            'since' => $this->since,
            'start' => $this->start,
            'until' => $this->until,
        ], fn($value) => $value !== null);
    }
}
