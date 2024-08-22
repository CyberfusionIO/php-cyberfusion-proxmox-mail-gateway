<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\VirusStatistics;
use Cyberfusion\ProxmoxMGW\Requests\VirusStatisticsGetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class VirusEndpoint extends Endpoint {
		/**
		 * Get Statistics about detected Viruses.
		 *
		 * @param VirusStatisticsGetRequest $request
		 *
		 * @return Result
		 */
		public function get( VirusStatisticsGetRequest $request ): Result {
				try {
						$response = $this->client->makeRequest(
								endpoint: '/statistics/virus',
								method  : 'GET',
								params  : $request->toArray()
						);

						$data = json_decode( $response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR );
				} catch ( Throwable $exception ) {
						return new Result(
								success: false,
								message: $exception->getMessage()
						);
				}

				$virusStatistics = collect();
				foreach ( Arr::get( $data, 'data', [] ) as $stat ) {
						$virusStatistics->push( new VirusStatistics(
								count: Arr::get( $stat, 'count' ),
								name : Arr::get( $stat, 'name' )
						) );
				}

				return new Result(
						success: true,
						data   : [
								'virusStatistics' => $virusStatistics,
						]
				);
		}
}
