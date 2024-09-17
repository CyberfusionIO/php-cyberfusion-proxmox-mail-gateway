<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class WhatSetConfigRequest
{
    /**
     * @param int $ogroup Object Group ID.
     * @param bool|null $and If set to 1, objects in this group are 'and' combined.
     * @param string|null $info Informational comment.
     * @param bool|null $invert If set to 1, the resulting match is inverted.
     * @param string|null $name Group name.
     */
    public function __construct(
        public int $ogroup,
        public ?bool $and = null,
        public ?string $info = null,
        public ?bool $invert = null,
        public ?string $name = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'and' => $this->and,
            'info' => $this->info,
            'invert' => $this->invert,
            'name' => $this->name,
        ], fn($value) => !is_null($value));
    }
}
