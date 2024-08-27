<?php

namespace Cyberfusion\ProxmoxMGW\Models\Config;

class AcmeChallengeSchemaItem
{
    /**
     * @param string $id
     * @param string $name Human readable name, falls back to id
     * @param object $schema
     * @param string $type
     */
    public function __construct(
        public string $id,
        public string $name,
        public object $schema,
        public string $type,
    ) {
    }
}
