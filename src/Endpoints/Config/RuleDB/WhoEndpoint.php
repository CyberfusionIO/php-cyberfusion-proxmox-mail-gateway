<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\WhoGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\CreateWhoGroupRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\GetWhoGroupConfigRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\ListWhoGroupObjectsRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\SetWhoGroupConfigRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class WhoEndpoint extends Endpoint
{
    /**
     * Get list of 'who' groups.
     *
     * @return Result
     */
    public function listWhoGroups(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/who',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $whoGroups = collect();
        foreach (Arr::get($data, 'data', []) as $group) {
            $whoGroups->push(new WhoGroup(
                id: Arr::get($group, 'id'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'whoGroups' => $whoGroups,
            ],
        );
    }

    /**
     * Create a new 'who' group.
     *
     * @param CreateWhoGroupRequest $request
     * @return Result
     */
    public function createWhoGroup(CreateWhoGroupRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/ruledb/who',
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
     * Get 'who' group properties.
     *
     * @param GetWhoGroupConfigRequest $request
     * @return Result
     */
    public function getWhoGroupConfig(GetWhoGroupConfigRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/config', $request->ogroup),
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
                'whoGroup' => new WhoGroup(
                    id: Arr::get($data, 'data.id'),
                    info: Arr::get($data, 'data.info'),
                    name: Arr::get($data, 'data.name'),
                ),
            ],
        );
    }

    /**
     * Modify 'who' group properties.
     *
     * @param SetWhoGroupConfigRequest $request
     * @return Result
     */
    public function setWhoGroupConfig(SetWhoGroupConfigRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/config', $request->ogroup),
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
     * List 'who' group objects.
     *
     * @param ListWhoGroupObjectsRequest $request
     * @return Result
     */
    public function listWhoGroupObjects(ListWhoGroupObjectsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/objects', $request->ogroup),
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
            $objects->push(new WhoGroup(
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
