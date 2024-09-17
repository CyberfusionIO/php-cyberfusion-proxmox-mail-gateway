<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class MatchFieldCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $field The Field (max length: 1024, pattern: [0-9a-zA-Z\/\\[\]\+-\.\*\_]+)
     * @param string $value The Value (max length: 1024)
     */
    public function __construct(
        public int $ogroup,
        public string $field,
        public string $value,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'field' => $this->field,
            'value' => $this->value,
        ];
    }
}
