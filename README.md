# proxmox-mail-gateway

PHP client for Proxmox Mail Gateway API.

Documentation: https://pmg.proxmox.com/pmg-docs/api-viewer/index.html

# Usage

## Example

```php
use YWatchman\ProxmoxMGW\Client;
use YWatchman\ProxmoxMGW\Endpoints\NetworkEndpoint;

$client = new Client('pmgtest.cyberfusion.nl', 'apiuser', 'Super secret password.');
$client->setAccess();

$endpoint = new NetworkEndpoint($client);
$network = $endpoint->getNetworks();
```
