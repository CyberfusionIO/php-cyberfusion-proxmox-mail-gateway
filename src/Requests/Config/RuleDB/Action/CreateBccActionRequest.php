<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class CreateBccActionRequest
{
    /**
     * @param string $name Action name.
     * @param string $target Send a Blind Carbon Copy to this email address.
     * @param string|null $info Informational comment.
     * @param bool $original Send the original, unmodified mail.
     */
    public function __construct(
        public string $name,
        public string $target,
        public ?string $info = null,
        public bool $original = true,
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
            'name' => $this->name,
            'target' => $this->target,
            'info' => $this->info,
            'original' => $this->original,
        ], fn($value) => $value !== null);
    }
}
