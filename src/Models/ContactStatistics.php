<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class ContactStatistics
{
    public function __construct(
        public int    $bytes,
        public string $contact,
        public ?int   $count = null,
        public ?int   $viruscount = null,
    ) {
    }
}
