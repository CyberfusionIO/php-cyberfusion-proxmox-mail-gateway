<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\ArchiveFilenameFilter;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\CreateArchiveFilenameFilterRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\ReadArchiveFilenameFilterRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\UpdateArchiveFilenameFilterRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ArchiveFilenameFilterEndpoint extends Endpoint
{
    /**
     * Add 'Match Archive Filename' object.
     *
     * @param CreateArchiveFilenameFilterRequest $request
     * @return Result
     */
    public function create(CreateArchiveFilenameFilterRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/archivefilenamefilter', $request->ogroup),
                method: 'POST',
                params: [
                    'filename' => $request->filename,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => $data]);
    }

    /**
     * Read 'Match Archive Filename' object settings.
     *
     * @param ReadArchiveFilenameFilterRequest $request
     * @return Result
     */
    public function read(ReadArchiveFilenameFilterRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/archivefilenamefilter/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'archiveFilenameFilter' => new ArchiveFilenameFilter(
                    id: Arr::get($data, 'id'),
                ),
            ],
        );
    }

    /**
     * Update 'Match Archive Filename' object.
     *
     * @param UpdateArchiveFilenameFilterRequest $request
     * @return Result
     */
    public function update(UpdateArchiveFilenameFilterRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/archivefilenamefilter/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: [
                    'filename' => $request->filename,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
