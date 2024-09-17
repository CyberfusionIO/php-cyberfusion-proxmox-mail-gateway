<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\WebauthnConfig;
use Cyberfusion\ProxmoxMGW\Requests\Config\UpdateWebauthnConfigRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class WebauthnEndpoint extends Endpoint
{
    /**
     * Read the webauthn configuration.
     *
     * @return Result
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/tfa/webauthn',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $config = new WebauthnConfig(
            allowSubdomains: Arr::get($data, 'data.allow-subdomains'),
            id: Arr::get($data, 'data.id'),
            origin: Arr::get($data, 'data.origin'),
            rp: Arr::get($data, 'data.rp'),
        );

        return new Result(
            success: true,
            data: [
                'config' => $config,
            ],
        );
    }

    /**
     * Update the webauthn configuration.
     *
     * @param UpdateWebauthnConfigRequest $request
     * @return Result
     */
    public function update(UpdateWebauthnConfigRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/tfa/webauthn',
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }
}
