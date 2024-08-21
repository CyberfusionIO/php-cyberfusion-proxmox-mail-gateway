# php-cyberfusion-proxmox-mail-gateway

Library for [Proxmox Mail Gateway](https://www.proxmox.com/en/proxmox-mail-gateway/overview).

Proxmox Mail Gateway API documentation: https://pmg.proxmox.com/pmg-docs/api-viewer/index.html

# Install

## Composer

Run the following command to install the package from Packagist:

    composer require cyberfusion/proxmox-mail-gateway

# Usage

## Example

```php
use Cyberfusion\ProxmoxMGW\Client;
use Cyberfusion\ProxmoxMGW\Endpoints\Config\DkimEndpoint;
use Cyberfusion\ProxmoxMGW\Exceptions\AuthenticationException;
use Cyberfusion\ProxmoxMGW\Models\DkimDomainData;
use Cyberfusion\ProxmoxMGW\Requests\DkimGetRequest;

try {
    $client = new Client('pmgtest.cyberfusion.nl');
    $client->authenticate('apiuser', 'Super secret password.');
} catch (AuthenticationException $e) {
    // Handle authentication error
}

$dkimEndpoint = new DkimEndpoint($client);
$result = $dkimEndpoint->get(new DkimGetRequest('example.com'));
if ($result->failed()) {
    // Handle error
}

/** @var DkimDomainData $dkim */
$dkim = $result->getData('dkim');
// $dkim->domain -> example.com
```
