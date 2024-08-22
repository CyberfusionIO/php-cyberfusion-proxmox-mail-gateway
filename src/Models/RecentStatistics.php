<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing recent mail count statistics.
 */
class RecentStatistics {
		/**
		 * @param int $bytes_in Number of incoming bytes mails.
		 * @param int $bytes_out Number of outgoing bytes mails.
		 * @param int $count Overall mail count (in and out).
		 * @param int $count_in Incoming mail count.
		 * @param int $count_out Outgoing mail count.
		 * @param int $index Time index.
		 * @param int $spam Overall spam mail count (in and out).
		 * @param int $spam_in Incoming spam mails (spamcount_in + glcount + spfcount).
		 * @param int $spam_out Outgoing spam mails.
		 * @param int $time Time (Unix epoch).
		 * @param int $timespan Timespan in seconds for one data point
		 * @param int $virus_in Number of incoming virus mails.
		 * @param int $virus_out Number of outgoing virus mails.
		 */
		public function __construct(
				public int $bytes_in,
				public int $bytes_out,
				public int $count,
				public int $count_in,
				public int $count_out,
				public int $index,
				public int $spam,
				public int $spam_in,
				public int $spam_out,
				public int $time,
				public int $timespan,
				public int $virus_in,
				public int $virus_out
		) {
		}
}
