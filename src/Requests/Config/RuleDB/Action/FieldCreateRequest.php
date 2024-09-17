<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action;

class FieldCreateRequest
{
    /**
     * @param string $field The Field
     * @param string|null $info Informational comment.
     * @param string $name Action name.
     * @param string $value The Value
     */
    public function __construct(
        public string $field,
        public ?string $info,
        public string $name,
        public string $value,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'field' => $this->field,
            'info' => $this->info,
            'name' => $this->name,
            'value' => $this->value,
        ], fn($value) => !is_null($value));
    }
}
