<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB;

class WhatCreateRequest
{
    /**
     * @param string $name Group name.
     * @param bool|null $and If set to 1, objects in this group are 'and' combined.
     * @param string|null $info Informational comment.
     * @param bool|null $invert If set to 1, the resulting match is inverted.
     */
    public function __construct(
        public string $name,
        public ?bool $and = null,
        public ?string $info = null,
        public ?bool $invert = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'and' => $this->and,
            'info' => $this->info,
            'invert' => $this->invert,
        ], fn($value) => !is_null($value));
    }
}
