<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class QuarantineDownloadRequest
 *
 * This class represents a request to download an email or attachment from the Proxmox Mail Gateway quarantine.
 */
class QuarantineDownloadRequest
{
    /**
     * @param string $mailid Unique ID
     * @param int|null $attachmentid The Attachment ID for the mail.
     */
    public function __construct(
        public string $mailid,
        public ?int $attachmentid = null,
    ) {
    }

    /**
     * Convert the request parameters to an array.
     *
     * @return array An array of non-null parameters.
     */
    public function toArray(): array
    {
        return array_filter([
            'mailid' => $this->mailid,
            'attachmentid' => $this->attachmentid,
        ], fn($value) => $value !== null);
    }
}
