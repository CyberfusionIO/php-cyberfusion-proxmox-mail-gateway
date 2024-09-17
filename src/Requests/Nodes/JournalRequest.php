<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class JournalRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string|null $endcursor End before the given Cursor. Conflicts with 'until'.
     * @param int|null $lastentries Limit to the last X lines. Conflicts with a range.
     * @param int|null $since Display all log since this UNIX epoch. Conflicts with 'startcursor'.
     * @param string|null $startcursor Start after the given Cursor. Conflicts with 'since'.
     * @param int|null $until Display all log until this UNIX epoch. Conflicts with 'endcursor'.
     */
    public function __construct(
        public string $node,
        public ?string $endcursor = null,
        public ?int $lastentries = null,
        public ?int $since = null,
        public ?string $startcursor = null,
        public ?int $until = null,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'endcursor' => $this->endcursor,
            'lastentries' => $this->lastentries,
            'since' => $this->since,
            'startcursor' => $this->startcursor,
            'until' => $this->until,
        ], fn($value) => $value !== null);
    }
}
