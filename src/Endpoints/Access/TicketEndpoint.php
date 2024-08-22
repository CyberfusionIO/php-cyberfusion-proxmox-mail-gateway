<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Access;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\AuthenticationTicket;
use Cyberfusion\ProxmoxMGW\Requests\TicketGetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class TicketEndpoint extends Endpoint {
		public function get( TicketGetRequest $request ): Result {
				try {
						$response = $this
								->client
								->makeRequest(
										endpoint: '/access/ticket',
										method  : 'POST',
										params  : [
												'username' => $request->username,
												'password' => $request->password,
												'realm'    => $request->realm,
										],
								);

						$data = json_decode( $response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR );
				} catch ( Throwable $exception ) {
						return new Result(
								success: false,
								message: $exception->getMessage(),
						);
				}

				return new Result(
						success: true,
						data   : [
								'authenticationTicket' => new AuthenticationTicket(
										username: Arr::get( $data, 'data.username' ),
										ticket  : Arr::get( $data, 'data.ticket' ),
										role    : Arr::get( $data, 'data.role' ),
										csrf    : Arr::get( $data, 'data.CSRFPreventionToken' ),
								),
						],
				);
		}
}
