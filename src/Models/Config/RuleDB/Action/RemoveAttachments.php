<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Action;

class RemoveAttachments
{
    /**
     * @param string $id Action Object ID.
     * @param bool|null $all Remove all attachments
     * @param string|null $info Informational comment.
     * @param string|null $name Action name.
     * @param bool|null $quarantine Copy original mail to attachment Quarantine.
     * @param string|null $text The replacement text.
     */
    public function __construct(
        public string $id,
        public ?bool $all = null,
        public ?string $info = null,
        public ?string $name = null,
        public ?bool $quarantine = null,
        public ?string $text = null,
    ) {
    }
}
