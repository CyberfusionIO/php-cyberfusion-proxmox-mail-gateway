<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class MatchFieldUpdateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param int $id Object ID.
     * @param string|null $field The Field (max length: 1024, pattern: [0-9a-zA-Z\/\\[\]\+-\.\*\_]+)
     * @param string|null $value The Value (max length: 1024)
     */
    public function __construct(
        public int $ogroup,
        public int $id,
        public ?string $field = null,
        public ?string $value = null,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'field' => $this->field,
            'value' => $this->value,
        ]);
    }
}
