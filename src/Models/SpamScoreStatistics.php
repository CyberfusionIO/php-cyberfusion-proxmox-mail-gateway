<?php

namespace Cyberfusion\ProxmoxMGW\Models;

/**
 * Model representing spam score statistics.
 */
class SpamScoreStatistics
{
		/**
		 * @param int $count Detection count.
		 * @param string $level Spam level.
		 * @param float $ratio Portion of overall mail count.
		 */
		public function __construct(
				public int $count,
				public string $level,
				public float $ratio
		) {}
}
