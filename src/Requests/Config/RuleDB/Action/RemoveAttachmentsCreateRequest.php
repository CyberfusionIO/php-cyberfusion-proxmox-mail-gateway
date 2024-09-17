<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class RemoveAttachmentsCreateRequest
{
    /**
     * @param string $name Action name.
     * @param bool|null $all Remove all attachments
     * @param string|null $info Informational comment.
     * @param bool|null $quarantine Copy original mail to attachment Quarantine.
     * @param string|null $text The replacement text.
     */
    public function __construct(
        public string $name,
        public ?bool $all = null,
        public ?string $info = null,
        public ?bool $quarantine = null,
        public ?string $text = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'all' => $this->all,
            'info' => $this->info,
            'quarantine' => $this->quarantine,
            'text' => $this->text,
        ], fn($value) => !is_null($value));
    }
}
