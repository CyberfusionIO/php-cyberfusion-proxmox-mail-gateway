# Proxmox Mail Gateway

Composer library to communicate with proxmox mail gateway machines.

## Example
```php
use YWatchman\ProxmoxMGW\Client;
use YWatchman\ProxmoxMGW\Endpoints\NetworkEndpoint;

$client = new Client('pmgtest.cyberfusion.nl', 'apiuser', 'Super secret password.');
$client->setAccess();

$endpoint = new NetworkEndpoint($client);
$network = $endpoint->getNetworks();

```
