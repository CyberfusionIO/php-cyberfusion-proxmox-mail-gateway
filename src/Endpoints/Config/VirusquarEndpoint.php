<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\VirusquarConfiguration;
use Cyberfusion\ProxmoxMGW\Requests\Config\VirusquarUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class VirusquarEndpoint extends Endpoint
{
    /**
     * Read virusquar configuration properties.
     *
     * @return Result
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/virusquar',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'configuration' => new VirusquarConfiguration(
                    allowhrefs: Arr::get($data, 'data.allowhrefs'),
                    lifetime: Arr::get($data, 'data.lifetime'),
                    viewimages: Arr::get($data, 'data.viewimages'),
                ),
            ],
        );
    }

    /**
     * Update virusquar configuration properties.
     *
     * @param VirusquarUpdateRequest $request
     * @return Result
     */
    public function update(VirusquarUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/virusquar',
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
