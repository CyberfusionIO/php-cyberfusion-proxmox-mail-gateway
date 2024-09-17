<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class DisclaimerUpdateRequest
{
    /**
     * @param string $id Action Object ID.
     * @param bool|null $addSeparator If set to 1, adds a '--' separator between the disclaimer and the content. Set to 0 to prevent that.
     * @param string|null $disclaimer The Disclaimer
     * @param string|null $info Informational comment.
     * @param string|null $name Action name.
     * @param string|null $position Put the disclaimer at the specified position.
     */
    public function __construct(
        public string $id,
        public ?bool $addSeparator = null,
        public ?string $disclaimer = null,
        public ?string $info = null,
        public ?string $name = null,
        public ?string $position = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'add-separator' => $this->addSeparator,
            'disclaimer' => $this->disclaimer,
            'info' => $this->info,
            'name' => $this->name,
            'position' => $this->position,
        ], fn($value) => !is_null($value));
    }
}
