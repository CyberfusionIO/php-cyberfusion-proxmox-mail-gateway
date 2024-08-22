<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Request class for fetching top recent mail receivers statistics.
 */
class RecentReceiversRequest {
		/**
		 * @param int $hours How many hours you want to get (1-24)
		 * @param int $limit The maximum number of receivers to return. (1-50)
		 */
		public function __construct(
				public int $hours = 12,
				public int $limit = 5
		) {
		}
}
