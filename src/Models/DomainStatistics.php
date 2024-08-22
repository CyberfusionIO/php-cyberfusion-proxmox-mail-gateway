<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing mail domain statistics.
 */
class DomainStatistics
{
		/**
		 * @param int $bytes_in Incoming mail traffic (Bytes).
		 * @param int $bytes_out Outgoing mail traffic (Bytes).
		 * @param int $count_in Incoming mail count.
		 * @param int $count_out Outgoing mail count.
		 * @param string $domain Domain name.
		 * @param int $spamcount_in Incoming spam mails.
		 * @param int $spamcount_out Outgoing spam mails.
		 * @param int $viruscount_in Number of incoming virus mails.
		 * @param int $viruscount_out Number of outgoing virus mails.
		 */
		public function __construct(
				public int $bytes_in,
				public int $bytes_out,
				public int $count_in,
				public int $count_out,
				public string $domain,
				public int $spamcount_in,
				public int $spamcount_out,
				public int $viruscount_in,
				public int $viruscount_out
		) {}
}
