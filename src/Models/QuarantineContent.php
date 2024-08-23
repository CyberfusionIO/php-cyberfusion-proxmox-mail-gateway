<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Class QuarantineContent
 *
 * This class represents the content of a quarantined email in the Proxmox Mail Gateway.
 */
class QuarantineContent
{
    /**
     * @param int $bytes Size of raw email.
     * @param string $content Raw email data (first 4096 bytes). Useful for preview.
     * @param string $envelope_sender SMTP envelope sender.
     * @param string $from Header 'From' field.
     * @param string $header Raw email header data.
     * @param string $id Unique ID
     * @param string $receiver Receiver email address
     * @param string|null $sender Header 'Sender' field.
     * @param array $spaminfo Information about matched spam tests (name, score, desc, url).
     * @param float $spamlevel Spam score.
     * @param string $subject Header 'Subject' field.
     * @param int $time Receive time stamp
     */
    public function __construct(
        public int $bytes,
        public string $content,
        public string $envelope_sender,
        public string $from,
        public string $header,
        public string $id,
        public string $receiver,
        public ?string $sender,
        public array $spaminfo,
        public float $spamlevel,
        public string $subject,
        public int $time,
    ) {
    }
}
