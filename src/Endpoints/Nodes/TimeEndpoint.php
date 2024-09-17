<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\TimeSettings;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\TimeGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\TimeUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class TimeEndpoint extends Endpoint
{
    /**
     * Read server time and time zone settings.
     *
     * @param TimeGetRequest $request
     * @return Result
     */
    public function get(TimeGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/time', $request->node),
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
                'timeSettings' => new TimeSettings(
                    localtime: Arr::get($data, 'localtime'),
                    time: Arr::get($data, 'time'),
                    timezone: Arr::get($data, 'timezone'),
                ),
            ],
        );
    }

    /**
     * Set time zone.
     *
     * @param TimeUpdateRequest $request
     * @return Result
     */
    public function update(TimeUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/time', $request->node),
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
