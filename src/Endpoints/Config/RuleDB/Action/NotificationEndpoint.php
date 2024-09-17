<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Action;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Action\Notification;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action\NotificationCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action\NotificationUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class NotificationEndpoint extends Endpoint
{
    /**
     * Create 'Notification' object.
     *
     * @param NotificationCreateRequest $request
     * @return Result
     */
    public function create(NotificationCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/action/notification',
                method: 'POST',
                params: $request->toArray(),
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
                'id' => Arr::get($data, 'data'),
            ],
        );
    }

    /**
     * Read 'Notification' object settings.
     *
     * @param string $id
     * @return Result
     */
    public function read(string $id): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: "/config/ruledb/action/notification/{$id}",
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
                'notification' => new Notification(
                    id: Arr::get($data, 'data.id'),
                    attach: Arr::get($data, 'data.attach'),
                    body: Arr::get($data, 'data.body'),
                    info: Arr::get($data, 'data.info'),
                    name: Arr::get($data, 'data.name'),
                    subject: Arr::get($data, 'data.subject'),
                    to: Arr::get($data, 'data.to'),
                ),
            ],
        );
    }

    /**
     * Update 'Notification' object.
     *
     * @param NotificationUpdateRequest $request
     * @return Result
     */
    public function update(NotificationUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: "/config/ruledb/action/notification/{$request->id}",
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
