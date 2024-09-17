<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix;

class ListMailQueueRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $queue Postfix queue name.
     * @param string|null $filter Filter string.
     * @param int|null $limit
     * @param string|null $sortdir Sort direction.
     * @param string|null $sortfield Sort field.
     * @param int|null $start
     */
    public function __construct(
        public string $node,
        public string $queue,
        public ?string $filter = null,
        public ?int $limit = null,
        public ?string $sortdir = null,
        public ?string $sortfield = null,
        public ?int $start = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'filter' => $this->filter,
            'limit' => $this->limit,
            'sortdir' => $this->sortdir,
            'sortfield' => $this->sortfield,
            'start' => $this->start,
        ], fn($value) => !is_null($value));
    }
}
