<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\QuarantineAttachment;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineAttachmentGetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Class QuarantineAttachmentEndpoint
 *
 * This class handles operations related to quarantined attachment mails in the Proxmox Mail Gateway.
 */
class QuarantineAttachmentEndpoint extends Endpoint {
		/**
		 * Get a list of quarantined attachment mails in the given timeframe.
		 *
		 * @param QuarantineAttachmentGetRequest $request The request object containing query parameters.
		 *
		 * @return Result The result object containing the list of quarantined attachment mails or error information.
		 */
		public function get( QuarantineAttachmentGetRequest $request ): Result {
				try {
						$response = $this->client->makeRequest(
								endpoint: '/quarantine/attachment',
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

				$quarantineAttachments = collect();
				foreach ( $data as $item ) {
						$quarantineAttachments->push( new QuarantineAttachment(
								bytes          : Arr::get( $item, 'bytes' ),
								envelope_sender: Arr::get( $item, 'envelope_sender' ),
								from           : Arr::get( $item, 'from' ),
								id             : Arr::get( $item, 'id' ),
								receiver       : Arr::get( $item, 'receiver' ),
								sender         : Arr::get( $item, 'sender' ),
								subject        : Arr::get( $item, 'subject' ),
								time           : Arr::get( $item, 'time' )
						) );
				}

				return new Result(
						success: true,
						data   : [
								'quarantineAttachments' => $quarantineAttachments,
						]
				);
		}
}
