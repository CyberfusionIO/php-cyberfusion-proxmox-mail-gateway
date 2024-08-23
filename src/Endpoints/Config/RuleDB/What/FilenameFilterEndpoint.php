<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\What;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\What\FilenameFilter;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What\FilenameFilterCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What\FilenameFilterGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What\FilenameFilterUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class FilenameFilterEndpoint extends Endpoint
{
    /**
     * Add 'Match Filename' object.
     *
     * @param FilenameFilterCreateRequest $request
     * @return Result
     */
    public function create(FilenameFilterCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/filenamefilter', $request->ogroup),
                method: 'POST',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => Arr::get($data, 'data')]);
    }

    /**
     * Read 'Match Filename' object settings.
     *
     * @param FilenameFilterGetRequest $request
     * @return Result
     */
    public function get(FilenameFilterGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/filenamefilter/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'filenameFilter' => new FilenameFilter(
                    id: Arr::get($data, 'data.id'),
                    filename: Arr::get($data, 'data.filename'),
                ),
            ],
        );
    }

    /**
     * Update 'Match Filename' object.
     *
     * @param FilenameFilterUpdateRequest $request
     * @return Result
     */
    public function update(FilenameFilterUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/filenamefilter/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
