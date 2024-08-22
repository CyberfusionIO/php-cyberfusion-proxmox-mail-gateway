<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing general mail statistics.
 */
class MailStatistics
{
		/**
		 * @param float $avptime Average mail processing time in seconds.
		 * @param int $bounces_in Incoming bounce mail count (sender = <>).
		 * @param int $bounces_out Outgoing bounce mail count (sender = <>).
		 * @param int $bytes_in Incoming mail traffic (bytes).
		 * @param int $bytes_out Outgoing mail traffic (bytes).
		 * @param int $count Overall mail count (in and out).
		 * @param int $count_in Incoming mail count.
		 * @param int $count_out Outgoing mail count.
		 * @param int $glcount Number of greylisted mails.
		 * @param int $junk_in Incoming junk mail count (viruscount_in + spamcount_in + glcount + spfcount + rbl_rejects + pregreet_rejects).
		 * @param int $junk_out Outgoing junk mail count (viruscount_out + spamcount_out).
		 * @param int $pregreet_rejects PREGREET reject count.
		 * @param int $rbl_rejects Number of RBL rejects.
		 * @param int $spamcount_in Incoming spam mails.
		 * @param int $spamcount_out Outgoing spam mails.
		 * @param int $spfcount Mails rejected by SPF.
		 * @param int $viruscount_in Number of incoming virus mails.
		 * @param int $viruscount_out Number of outgoing virus mails.
		 */
		public function __construct(
				public float $avptime,
				public int $bounces_in,
				public int $bounces_out,
				public int $bytes_in,
				public int $bytes_out,
				public int $count,
				public int $count_in,
				public int $count_out,
				public int $glcount,
				public int $junk_in,
				public int $junk_out,
				public int $pregreet_rejects,
				public int $rbl_rejects,
				public int $spamcount_in,
				public int $spamcount_out,
				public int $spfcount,
				public int $viruscount_in,
				public int $viruscount_out
		) {}
}
