<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\What;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\What\ArchiveFilter;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What\ArchiveFilterCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What\ArchiveFilterGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\What\ArchiveFilterUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ArchiveFilterEndpoint extends Endpoint
{
    /**
     * Add 'Archive Filter' object.
     *
     * @param ArchiveFilterCreateRequest $request
     * @return Result
     */
    public function create(ArchiveFilterCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/archivefilter', $request->ogroup),
                method: 'POST',
                params: [
                    'contenttype' => $request->contenttype,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => $data]);
    }

    /**
     * Read 'Archive Filter' object settings.
     *
     * @param ArchiveFilterGetRequest $request
     * @return Result
     */
    public function get(ArchiveFilterGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/archivefilter/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'archiveFilter' => new ArchiveFilter(
                    id: Arr::get($data, 'id'),
                    contenttype: Arr::get($data, 'contenttype'),
                ),
            ],
        );
    }

    /**
     * Update 'Archive Filter' object.
     *
     * @param ArchiveFilterUpdateRequest $request
     * @return Result
     */
    public function update(ArchiveFilterUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/archivefilter/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: [
                    'contenttype' => $request->contenttype,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
