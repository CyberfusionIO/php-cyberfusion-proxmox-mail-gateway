<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\ReceiverStatistics;
use Cyberfusion\ProxmoxMGW\Requests\ReceiverRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Endpoint for fetching receiver address statistics.
 */
class ReceiverEndpoint extends Endpoint {
		/**
		 * Get receiver address statistics.
		 *
		 * @param ReceiverRequest $request
		 *
		 * @return Result
		 */
		public function get( ReceiverRequest $request ): Result {
				try {
						$response = $this->client->makeRequest(
								endpoint: '/statistics/receiver',
								method  : 'GET',
								params  : [
										'day'       => $request->day,
										'endtime'   => $request->endtime,
										'filter'    => $request->filter,
										'month'     => $request->month,
										'orderby'   => $request->orderby,
										'starttime' => $request->starttime,
										'year'      => $request->year,
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
						$statistics->push( new ReceiverStatistics(
								bytes     : Arr::get( $stat, 'bytes', 0 ),
								receiver  : Arr::get( $stat, 'receiver', '' ),
								count     : Arr::get( $stat, 'count' ),
								spamcount : Arr::get( $stat, 'spamcount' ),
								viruscount: Arr::get( $stat, 'viruscount' )
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
