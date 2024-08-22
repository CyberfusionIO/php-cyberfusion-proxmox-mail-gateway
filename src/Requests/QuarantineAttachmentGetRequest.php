<?php

namespace Cyberfusion\ProxmoxMGW\Requests;

/**
 * Class QuarantineAttachmentGetRequest
 *
 * This class represents a request to get a list of quarantined attachment mails from the Proxmox Mail Gateway.
 */
class QuarantineAttachmentGetRequest {
		/**
		 * @param int|null $endtime Only consider entries older than 'endtime' (unix epoch). This is set to '<start> + 1day' by default.
		 * @param string|null $pmail List entries for the user with this primary email address. Quarantine users cannot specify this parameter, but it is required for all other roles.
		 * @param int|null $starttime Only consider entries newer than 'starttime' (unix epoch). Default is 'now - 1day'.
		 */
		public function __construct(
				public ?int    $endtime = null,
				public ?string $pmail = null,
				public ?int    $starttime = null
		) {
		}

		/**
		 * Convert the request parameters to an array.
		 *
		 * @return array An array of non-null parameters.
		 */
		public function toArray(): array {
				return array_filter( [
						'endtime'   => $this->endtime,
						'pmail'     => $this->pmail,
						'starttime' => $this->starttime,
				], fn( $value ) => $value !== null );
		}
}
