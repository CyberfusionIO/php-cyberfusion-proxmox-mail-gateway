<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing receiver address statistics.
 */
class ReceiverStatistics
{
		/**
		 * @param int $bytes Mail traffic (Bytes).
		 * @param string $receiver Sender email.
		 * @param int|null $count Mail count.
		 * @param int|null $spamcount Number of sent spam mails.
		 * @param int|null $viruscount Number of sent virus mails.
		 */
		public function __construct(
				public int $bytes,
				public string $receiver,
				public ?int $count = null,
				public ?int $spamcount = null,
				public ?int $viruscount = null
		) {}
}
