<?php

namespace Cyberfusion\ProxmoxMGW\Models;

class Version {
		/**
		 * @param string $release The current installed Proxmox Mailgateway Release
		 * @param string $repoid The short git commit hash ID from which this version was build
		 * @param string $version The current installed pmg-api package version
		 */
		public function __construct(
				public string $release,
				public string $repoid,
				public string $version
		) {
		}
}
