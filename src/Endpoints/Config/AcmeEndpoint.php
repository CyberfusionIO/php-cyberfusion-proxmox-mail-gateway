<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class AcmeEndpoint extends Endpoint
{
    /**
     * ACME index.
     *
     * @return Result
     */
    public function index(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/acme',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: $data);
    }
}
