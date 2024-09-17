<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Acme;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmeAccountDeactivateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmeAccountGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmeAccountUpdateRequest;
use Cyberfusion\ProxmoxMGW\Models\Config\Acme\AcmeAccountInfo;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class AcmeAccountNameEndpoint extends Endpoint
{
    /**
     * Deactivate existing ACME account at CA.
     *
     * @param AcmeAccountDeactivateRequest $request
     * @return Result
     */
    public function deactivate(AcmeAccountDeactivateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/acme/account/%s', $request->name),
                method: 'DELETE',
                params: $request->toArray(),
            );

            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['result' => $data]);
    }

    /**
     * Return existing ACME account information.
     *
     * @param AcmeAccountGetRequest $request
     * @return Result
     */
    public function get(AcmeAccountGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/acme/account/%s', $request->name),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $accountInfo = new AcmeAccountInfo($data);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['accountInfo' => $accountInfo]);
    }

    /**
     * Update existing ACME account information with CA.
     *
     * @param AcmeAccountUpdateRequest $request
     * @return Result
     */
    public function update(AcmeAccountUpdateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/acme/account/%s', $request->name),
                method: 'PUT',
                params: $request->toArray(),
            );

            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['result' => $data]);
    }
}
