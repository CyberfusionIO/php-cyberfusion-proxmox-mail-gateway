<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Whitelist\ReceiverRegex;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverRegexCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\ReceiverRegexUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ReceiverRegexEndpoint extends Endpoint
{
    /**
     * Add 'Regular Expression' object.
     *
     * @param ReceiverRegexCreateRequest $request
     * @return Result
     */
    public function create(ReceiverRegexCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/receiver_regex',
                method: 'POST',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => $data]);
    }

    /**
     * Read 'Regular Expression' object settings.
     *
     * @param int $id
     * @return Result
     */
    public function get(int $id): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: "/config/whitelist/receiver_regex/{$id}",
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'receiverRegex' => new ReceiverRegex(
                    id: Arr::get($data, 'id'),
                    regex: Arr::get($data, 'regex'),
                ),
            ],
        );
    }

    /**
     * Update 'Regular Expression' object.
     *
     * @param ReceiverRegexUpdateRequest $request
     * @return Result
     */
    public function update(ReceiverRegexUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: "/config/whitelist/receiver_regex/{$request->id}",
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
