<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action;

class FieldUpdateRequest
{
    /**
     * @param string $field The Field
     * @param string $id Action Object ID.
     * @param string|null $info Informational comment.
     * @param string|null $name Action name.
     * @param string $value The Value
     */
    public function __construct(
        public string $field,
        public string $id,
        public ?string $info = null,
        public ?string $name = null,
        public string $value,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'field' => $this->field,
            'id' => $this->id,
            'info' => $this->info,
            'name' => $this->name,
            'value' => $this->value,
        ], fn($value) => !is_null($value));
    }
}
