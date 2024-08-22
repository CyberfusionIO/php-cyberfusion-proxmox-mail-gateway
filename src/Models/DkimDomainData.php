<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class DkimDomainData {
		public function __construct(
				public string $domain,
				public string $comment = '',
		) {
		}
}
