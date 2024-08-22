<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\RecentStatistics;
use Cyberfusion\ProxmoxMGW\Requests\RecentRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Endpoint for fetching recent mail count statistics.
 */
class RecentEndpoint extends Endpoint {
		/**
		 * Get recent mail count statistics.
		 *
		 * @param RecentRequest $request
		 *
		 * @return Result
		 */
		public function get( RecentRequest $request ): Result {
				try {
						$response = $this->client->makeRequest(
								endpoint: '/statistics/recent',
								method  : 'GET',
								params  : [
										'hours'    => $request->hours,
										'timespan' => $request->timespan,
								]
						);

						$data = json_decode( $response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR );
				} catch ( Throwable $exception ) {
						return new Result(
								success: false,
								message: $exception->getMessage()
						);
				}

				$statistics = collect();
				foreach ( Arr::get( $data, 'data', [] ) as $stat ) {
						$statistics->push( new RecentStatistics(
								bytes_in : Arr::get( $stat, 'bytes_in', 0 ),
								bytes_out: Arr::get( $stat, 'bytes_out', 0 ),
								count    : Arr::get( $stat, 'count', 0 ),
								count_in : Arr::get( $stat, 'count_in', 0 ),
								count_out: Arr::get( $stat, 'count_out', 0 ),
								index    : Arr::get( $stat, 'index', 0 ),
								spam     : Arr::get( $stat, 'spam', 0 ),
								spam_in  : Arr::get( $stat, 'spam_in', 0 ),
								spam_out : Arr::get( $stat, 'spam_out', 0 ),
								time     : Arr::get( $stat, 'time', 0 ),
								timespan : Arr::get( $stat, 'timespan', 0 ),
								virus_in : Arr::get( $stat, 'virus_in', 0 ),
								virus_out: Arr::get( $stat, 'virus_out', 0 )
						) );
				}

				return new Result(
						success: true,
						data   : [
								'statistics' => $statistics,
						]
				);
		}
}
