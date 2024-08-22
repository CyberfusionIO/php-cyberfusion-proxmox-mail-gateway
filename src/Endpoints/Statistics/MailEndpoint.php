<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Statistics;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\MailStatistics;
use Cyberfusion\ProxmoxMGW\Requests\MailRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Endpoint for fetching general mail statistics.
 */
class MailEndpoint extends Endpoint {
		/**
		 * Get general mail statistics.
		 *
		 * @param MailRequest $request
		 *
		 * @return Result
		 */
		public function get( MailRequest $request ): Result {
				try {
						$response = $this->client->makeRequest(
								endpoint: '/statistics/mail',
								method  : 'GET',
								params  : [
										'day'       => $request->day,
										'endtime'   => $request->endtime,
										'month'     => $request->month,
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

				$statistics = new MailStatistics(
						avptime         : Arr::get( $data, 'data.avptime', 0.0 ),
						bounces_in      : Arr::get( $data, 'data.bounces_in', 0 ),
						bounces_out     : Arr::get( $data, 'data.bounces_out', 0 ),
						bytes_in        : Arr::get( $data, 'data.bytes_in', 0 ),
						bytes_out       : Arr::get( $data, 'data.bytes_out', 0 ),
						count           : Arr::get( $data, 'data.count', 0 ),
						count_in        : Arr::get( $data, 'data.count_in', 0 ),
						count_out       : Arr::get( $data, 'data.count_out', 0 ),
						glcount         : Arr::get( $data, 'data.glcount', 0 ),
						junk_in         : Arr::get( $data, 'data.junk_in', 0 ),
						junk_out        : Arr::get( $data, 'data.junk_out', 0 ),
						pregreet_rejects: Arr::get( $data, 'data.pregreet_rejects', 0 ),
						rbl_rejects     : Arr::get( $data, 'data.rbl_rejects', 0 ),
						spamcount_in    : Arr::get( $data, 'data.spamcount_in', 0 ),
						spamcount_out   : Arr::get( $data, 'data.spamcount_out', 0 ),
						spfcount        : Arr::get( $data, 'data.spfcount', 0 ),
						viruscount_in   : Arr::get( $data, 'data.viruscount_in', 0 ),
						viruscount_out  : Arr::get( $data, 'data.viruscount_out', 0 )
				);

				return new Result(
						success: true,
						data   : [
								'statistics' => $statistics,
						]
				);
		}
}
