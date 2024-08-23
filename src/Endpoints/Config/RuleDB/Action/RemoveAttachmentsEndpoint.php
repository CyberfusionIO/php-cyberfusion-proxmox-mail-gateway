<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Action;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Action\RemoveAttachments;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action\RemoveAttachmentsCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action\RemoveAttachmentsGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Action\RemoveAttachmentsUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RemoveAttachmentsEndpoint extends Endpoint
{
    /**
     * Create 'Remove attachments' object.
     *
     * @param RemoveAttachmentsCreateRequest $request
     * @return Result
     */
    public function create(RemoveAttachmentsCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/action/removeattachments',
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
     * Read 'Remove attachments' object settings.
     *
     * @param RemoveAttachmentsGetRequest $request
     * @return Result
     */
    public function get(RemoveAttachmentsGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/removeattachments/%s', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'removeAttachments' => new RemoveAttachments(
                    id: Arr::get($data, 'id'),
                    // Add other properties here
                ),
            ],
        );
    }

    /**
     * Update 'Remove attachments' object.
     *
     * @param RemoveAttachmentsUpdateRequest $request
     * @return Result
     */
    public function update(RemoveAttachmentsUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/removeattachments/%s', $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
