<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Class QuarantineAttachment
 *
 * This class represents a quarantined attachment mail entry from the Proxmox Mail Gateway.
 */
class QuarantineAttachment {
		/**
		 * @param int $bytes Size of raw email.
		 * @param string $envelope_sender SMTP envelope sender.
		 * @param string $from Header 'From' field.
		 * @param string $id Unique ID
		 * @param string $receiver Receiver email address
		 * @param string|null $sender Header 'Sender' field.
		 * @param string $subject Header 'Subject' field.
		 * @param int $time Receive time stamp
		 */
		public function __construct(
				public int     $bytes,
				public string  $envelope_sender,
				public string  $from,
				public string  $id,
				public string  $receiver,
				public ?string $sender,
				public string  $subject,
				public int     $time
		) {
		}
}
