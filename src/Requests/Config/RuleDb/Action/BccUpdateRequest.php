<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action;

class BccUpdateRequest
{
    /**
     * @param string $id Action Object ID.
     * @param string|null $info Informational comment.
     * @param string|null $name Action name.
     * @param bool|null $original Send the original, unmodified mail.
     * @param string $target Send a Blind Carbon Copy to this email address.
     */
    public function __construct(
        public string $id,
        public ?string $info = null,
        public ?string $name = null,
        public ?bool $original = null,
        public string $target,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'info' => $this->info,
            'name' => $this->name,
            'original' => $this->original,
            'target' => $this->target,
        ], fn($value) => !is_null($value));
    }
}
