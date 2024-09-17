<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Acme;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Acme\AcmeDirectory;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class AcmeDirectoriesEndpoint
 *
 * Endpoint for retrieving named known ACME directory endpoints.
 */
class AcmeDirectoriesEndpoint extends Endpoint
{
    /**
     * Get named known ACME directory endpoints.
     *
     * @return Result
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/acme/directories',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $directories = [];
        foreach ($data['data'] as $directory) {
            $directories[] = new AcmeDirectory(
                name: $directory['name'],
                url: $directory['url'],
            );
        }

        return new Result(
            success: true,
            data: [
                'directories' => $directories,
            ],
        );
    }
}
