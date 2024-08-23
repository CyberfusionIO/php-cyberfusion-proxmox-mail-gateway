<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\MatchField;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\MatchFieldCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\MatchFieldGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\MatchFieldUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class MatchFieldEndpoint extends Endpoint
{
    /**
     * Add 'Match Field' object.
     *
     * @param MatchFieldCreateRequest $request
     * @return Result
     */
    public function create(MatchFieldCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/matchfield', $request->ogroup),
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
     * Read 'Match Field' object settings.
     *
     * @param MatchFieldGetRequest $request
     * @return Result
     */
    public function get(MatchFieldGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/matchfield/%d', $request->ogroup, $request->id),
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
                'matchField' => new MatchField(
                    id: Arr::get($data, 'data.id'),
                    field: Arr::get($data, 'data.field'),
                    value: Arr::get($data, 'data.value'),
                ),
            ],
        );
    }

    /**
     * Update 'Match Field' object.
     *
     * @param MatchFieldUpdateRequest $request
     * @return Result
     */
    public function update(MatchFieldUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/matchfield/%d', $request->ogroup, $request->id),
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
