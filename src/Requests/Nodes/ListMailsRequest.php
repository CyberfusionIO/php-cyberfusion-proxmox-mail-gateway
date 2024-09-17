<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class ListMailsRequest
{
    /**
     * @param string $node The cluster node name.
     * @param int|null $endtime Only consider entries older than 'endtime' (unix epoch). This is set to '<start> + 1day' by default.
     * @param string|null $from Sender email address filter.
     * @param bool $greylist Include Greylisted entries.
     * @param bool $ndr Include NDRs (non delivery reports).
     * @param int|null $starttime Only consider entries newer than 'starttime' (unix epoch). Default is 'now - 1day'.
     * @param string|null $target Receiver email address filter.
     * @param string|null $xfilter Only include mails containing this filter string.
     */
    public function __construct(
        public string $node,
        public ?int $endtime = null,
        public ?string $from = null,
        public bool $greylist = false,
        public bool $ndr = false,
        public ?int $starttime = null,
        public ?string $target = null,
        public ?string $xfilter = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'endtime' => $this->endtime,
            'from' => $this->from,
            'greylist' => $this->greylist,
            'ndr' => $this->ndr,
            'starttime' => $this->starttime,
            'target' => $this->target,
            'xfilter' => $this->xfilter,
        ], fn($value) => !is_null($value));
    }
}
