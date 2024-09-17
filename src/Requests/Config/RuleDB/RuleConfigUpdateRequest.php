<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class RuleConfigUpdateRequest
{
    /**
     * @param int $id Rule ID.
     * @param bool|null $active Flag to activate rule.
     * @param int|null $direction Rule direction. Value `0` matches incoming mails, value `1` matches outgoing mails, and value `2` matches both directions.
     * @param bool|null $fromAnd Flag to 'and' combine FROM group matches.
     * @param bool|null $fromInvert Flag to invert FROM group matches.
     * @param string|null $name Rule name
     * @param int|null $priority Rule priority.
     * @param bool|null $toAnd Flag to 'and' combine TO group matches.
     * @param bool|null $toInvert Flag to invert TO group matches.
     * @param bool|null $whatAnd Flag to 'and' combine WHAT group matches.
     * @param bool|null $whatInvert Flag to invert WHAT group matches.
     * @param bool|null $whenAnd Flag to 'and' combine WHEN group matches.
     * @param bool|null $whenInvert Flag to invert WHEN group matches.
     */
    public function __construct(
        public int $id,
        public ?bool $active = null,
        public ?int $direction = null,
        public ?bool $fromAnd = null,
        public ?bool $fromInvert = null,
        public ?string $name = null,
        public ?int $priority = null,
        public ?bool $toAnd = null,
        public ?bool $toInvert = null,
        public ?bool $whatAnd = null,
        public ?bool $whatInvert = null,
        public ?bool $whenAnd = null,
        public ?bool $whenInvert = null,
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
            'id' => $this->id,
            'active' => $this->active,
            'direction' => $this->direction,
            'from-and' => $this->fromAnd,
            'from-invert' => $this->fromInvert,
            'name' => $this->name,
            'priority' => $this->priority,
            'to-and' => $this->toAnd,
            'to-invert' => $this->toInvert,
            'what-and' => $this->whatAnd,
            'what-invert' => $this->whatInvert,
            'when-and' => $this->whenAnd,
            'when-invert' => $this->whenInvert,
        ], fn($value) => !is_null($value));
    }
}
