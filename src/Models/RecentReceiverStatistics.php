<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing recent receiver statistics.
 */
class RecentReceiverStatistics
{
		/**
		 * @param int $count The count of incoming not blocked E-Mails
		 * @param string $receiver The receiver
		 */
		public function __construct(
				public int $count,
				public string $receiver
		) {}
}
