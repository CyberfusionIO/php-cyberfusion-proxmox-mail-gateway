<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\WhatGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\WhatCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\WhatGetConfigRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\WhatSetConfigRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\WhatListObjectsRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class WhatEndpoint extends Endpoint
{
    /**
     * Get list of 'what' groups.
     *
     * @return Result
     */
    public function listWhatGroups(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/what',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $whatGroups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $whatGroups->push(new WhatGroup(
                id: Arr::get($group, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'whatGroups' => $whatGroups,
            ],
        );
    }

    /**
     * Create a new 'what' group.
     *
     * @param WhatCreateRequest $request
     * @return Result
     */
    public function createWhatGroup(WhatCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/what',
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
     * Get 'what' group properties.
     *
     * @param WhatGetConfigRequest $request
     * @return Result
     */
    public function getConfig(WhatGetConfigRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/config', $request->ogroup),
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
                'whatGroup' => new WhatGroup(
                    id: Arr::get($data, 'data.id'),
                    info: Arr::get($data, 'data.info'),
                    name: Arr::get($data, 'data.name'),
                ),
            ],
        );
    }

    /**
     * Modify 'what' group properties.
     *
     * @param WhatSetConfigRequest $request
     * @return Result
     */
    public function setConfig(WhatSetConfigRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/config', $request->ogroup),
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

    /**
     * List 'what' group objects.
     *
     * @param WhatListObjectsRequest $request
     * @return Result
     */
    public function listObjects(WhatListObjectsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/objects', $request->ogroup),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $objects = collect();
        foreach (Arr::get($data, 'data', []) as $object) {
            $objects->push(new WhatGroup(
                id: Arr::get($object, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'objects' => $objects,
            ],
        );
    }
}
