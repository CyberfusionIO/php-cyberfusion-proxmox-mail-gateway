<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDb\Action;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\Action\Field;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action\FieldCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action\FieldGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Action\FieldUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class FieldEndpoint extends Endpoint
{
    /**
     * Create 'Header Attribute' object.
     *
     * @param FieldCreateRequest $request
     * @return Result
     */
    public function create(FieldCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/action/field',
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
                'id' => $data,
            ],
        );
    }

    /**
     * Read 'Header Attribute' object settings.
     *
     * @param FieldGetRequest $request
     * @return Result
     */
    public function get(FieldGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/field/%s', $request->id),
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
                'field' => new Field(
                    id: Arr::get($data, 'id'),
                ),
            ],
        );
    }

    /**
     * Update 'Header Attribute' object.
     *
     * @param FieldUpdateRequest $request
     * @return Result
     */
    public function update(FieldUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/action/field/%s', $request->id),
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
