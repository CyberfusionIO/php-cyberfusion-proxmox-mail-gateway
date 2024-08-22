<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints;

use Cyberfusion\ProxmoxMGW\Models\Version;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class VersionEndpoint extends Endpoint {
		/**
		 * Get API version details.
		 *
		 * @return Result
		 */
		public function get(): Result {
				try {
						$response = $this->client->makeRequest(
								endpoint: '/version',
								method  : 'GET'
						);

						$data = json_decode( $response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR );
				} catch ( Throwable $exception ) {
						return new Result(
								success: false,
								message: $exception->getMessage()
						);
				}

				return new Result(
						success: true,
						data   : [
								'version' => new Version(
										release: Arr::get( $data, 'data.release' ),
										repoid : Arr::get( $data, 'data.repoid' ),
										version: Arr::get( $data, 'data.version' )
								),
						]
				);
		}
}
