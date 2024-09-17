<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class DisclaimerCreateRequest
{
    /**
     * @param string $name Action name.
     * @param string $disclaimer The Disclaimer
     * @param bool|null $addSeparator If set to 1, adds a '--' separator between the disclaimer and the content. Set to 0 to prevent that.
     * @param string|null $info Informational comment.
     * @param string|null $position Put the disclaimer at the specified position.
     */
    public function __construct(
        public string $name,
        public string $disclaimer,
        public ?bool $addSeparator = null,
        public ?string $info = null,
        public ?string $position = null,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'disclaimer' => $this->disclaimer,
            'add-separator' => $this->addSeparator,
            'info' => $this->info,
            'position' => $this->position,
        ], fn($value) => !is_null($value));
    }
}
