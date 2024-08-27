<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class MimeType
{
    /**
     * @param string $mimetype The MIME type
     * @param string $text The text description of the MIME type
     */
    public function __construct(
        public string $mimetype,
        public string $text,
    ) {
    }
}
