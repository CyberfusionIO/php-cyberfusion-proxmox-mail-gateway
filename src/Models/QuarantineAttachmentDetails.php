<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Class QuarantineAttachmentDetails
 *
 * This class represents detailed information about an attachment in a quarantined email in the Proxmox Mail Gateway.
 */
class QuarantineAttachmentDetails
{
    /**
     * @param string $contentType Raw email header data.
     * @param int $id Attachment ID
     * @param string $name Raw email header data.
     * @param int $size Size of raw attachment in bytes.
     */
    public function __construct(
        public string $contentType,
        public int $id,
        public string $name,
        public int $size,
    ) {
    }
}
