<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\When\WhenGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\CreateWhenGroupRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\GetWhenGroupConfigRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\ListWhenGroupObjectsRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\ListWhenGroupsRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\When\SetWhenGroupConfigRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class WhenEndpoint extends Endpoint
{
    /**
     * Get list of 'when' groups.
     *
     * @param ListWhenGroupsRequest $request
     * @return Result
     */
    public function listWhenGroups(ListWhenGroupsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/when',
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $whenGroups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $whenGroups->push(new WhenGroup(
                id: Arr::get($group, 'id'),
            ));
        }

        return new Result(success: true, data: ['whenGroups' => $whenGroups]);
    }

    /**
     * Create a new 'when' group.
     *
     * @param CreateWhenGroupRequest $request
     * @return Result
     */
    public function createWhenGroup(CreateWhenGroupRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/when',
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
     * Get 'when' group properties.
     *
     * @param GetWhenGroupConfigRequest $request
     * @return Result
     */
    public function getWhenGroupConfig(GetWhenGroupConfigRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/when/%d/config', $request->ogroup),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $whenGroup = new WhenGroup(
            id: Arr::get($data, 'data.id'),
            info: Arr::get($data, 'data.info'),
            name: Arr::get($data, 'data.name'),
        );

        return new Result(success: true, data: ['whenGroup' => $whenGroup]);
    }

    /**
     * Modify 'when' group properties.
     *
     * @param SetWhenGroupConfigRequest $request
     * @return Result
     */
    public function setWhenGroupConfig(SetWhenGroupConfigRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/when/%d/config', $request->ogroup),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * List 'when' group objects.
     *
     * @param ListWhenGroupObjectsRequest $request
     * @return Result
     */
    public function listWhenGroupObjects(ListWhenGroupObjectsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/when/%d/objects', $request->ogroup),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $objects = collect();
        foreach (Arr::get($data, 'data', []) as $object) {
            $objects->push(new WhenGroup(
                id: Arr::get($object, 'id'),
            ));
        }

        return new Result(success: true, data: ['objects' => $objects]);
    }
}
