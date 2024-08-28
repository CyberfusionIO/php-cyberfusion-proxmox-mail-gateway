<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

/**
 * Class RrdDataRequest
 *
 * This class represents a request to read node RRD statistics.
 */
class RrdDataRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string|null $cf The RRD consolidation function (AVERAGE or MAX).
     * @param string $timeframe Specify the time frame you are interested in (hour, day, week, month, year).
     */
    public function __construct(
        public string $node,
        public ?string $cf = null,
        public string $timeframe,
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
            'cf' => $this->cf,
            'timeframe' => $this->timeframe,
        ], fn($value) => $value !== null);
    }
}
