<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Whitelist\Receiver;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ReceiverEndpoint extends Endpoint
{
    /**
     * Add 'Mail address' object.
     *
     * @param ReceiverCreateRequest $request
     * @return Result
     */
    public function create(ReceiverCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                '/config/whitelist/receiver',
                'POST',
                [
                    'email' => $request->email,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => $data]);
    }

    /**
     * Read 'Mail address' object settings.
     *
     * @param ReceiverGetRequest $request
     * @return Result
     */
    public function get(ReceiverGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                sprintf('/config/whitelist/receiver/%d', $request->id),
                'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'receiver' => new Receiver(
                    id: Arr::get($data, 'id'),
                    email: Arr::get($data, 'email'),
                ),
            ],
        );
    }

    /**
     * Update 'Mail address' object.
     *
     * @param ReceiverUpdateRequest $request
     * @return Result
     */
    public function update(ReceiverUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                sprintf('/config/whitelist/receiver/%d', $request->id),
                'PUT',
                [
                    'email' => $request->email,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
