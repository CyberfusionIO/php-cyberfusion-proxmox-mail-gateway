<?php

namespace Cyberfusion\ProxmoxMGW\Models\Nodes;

class Backup
{
    /**
     * @param string $filename The backup file name.
     * @param int $size Size of backup file in bytes.
     * @param int $timestamp Backup timestamp (Unix epoch).
     */
    public function __construct(
        public string $filename,
        public int $size,
        public int $timestamp,
    ) {
    }
}
