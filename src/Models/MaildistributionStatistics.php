<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing mail distribution statistics.
 */
class MaildistributionStatistics
{
		/**
		 * @param int $bounces_in Incoming bounce mail count (sender = <>).
		 * @param int $bounces_out Outgoing bounce mail count (sender = <>).
		 * @param int $count Overall mail count (in and out).
		 * @param int $count_in Incoming mail count.
		 * @param int $count_out Outgoing mail count.
		 * @param int $index Hour (0-23).
		 * @param int $spamcount_in Incoming spam mails (spamcount_in + glcount + spfcount).
		 * @param int $spamcount_out Outgoing spam mails.
		 * @param int $viruscount_in Number of incoming virus mails.
		 * @param int $viruscount_out Number of outgoing virus mails.
		 */
		public function __construct(
				public int $bounces_in,
				public int $bounces_out,
				public int $count,
				public int $count_in,
				public int $count_out,
				public int $index,
				public int $spamcount_in,
				public int $spamcount_out,
				public int $viruscount_in,
				public int $viruscount_out
		) {}
}
