<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Acme;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmeAccountIndexRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmeAccountRegisterRequest;
use Cyberfusion\ProxmoxMGW\Models\Config\Acme\AcmeAccountIndex;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class AcmeAccountEndpoint extends Endpoint
{
    /**
     * ACME account index.
     *
     * @param AcmeAccountIndexRequest $request
     * @return Result
     */
    public function index(AcmeAccountIndexRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/acme/account',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $accounts = array_map(fn($item) => new AcmeAccountIndex($item), $data);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['accounts' => $accounts]);
    }

    /**
     * Register a new ACME account with CA.
     *
     * @param AcmeAccountRegisterRequest $request
     * @return Result
     */
    public function register(AcmeAccountRegisterRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/acme/account',
                method: 'POST',
                params: $request->toArray(),
            );

            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['result' => $data]);
    }
}
