<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Backup;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\BackupListRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\BackupCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\BackupDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\BackupDownloadRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\BackupRestoreRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class BackupEndpoint extends Endpoint
{
    /**
     * List all stored backups.
     *
     * @param BackupListRequest $request
     * @return Result
     */
    public function list(BackupListRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/backup', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $backups = collect();
        foreach (Arr::get($data, 'data', []) as $backup) {
            $backups->push(new Backup(
                filename: Arr::get($backup, 'filename'),
                size: Arr::get($backup, 'size'),
                timestamp: Arr::get($backup, 'timestamp'),
            ));
        }

        return new Result(success: true, data: ['backups' => $backups]);
    }

    /**
     * Backup the system configuration.
     *
     * @param BackupCreateRequest $request
     * @return Result
     */
    public function create(BackupCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/backup', $request->node),
                method: 'POST',
                params: $request->toArray(),
            );

            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['result' => $data]);
    }

    /**
     * Delete a backup file.
     *
     * @param BackupDeleteRequest $request
     * @return Result
     */
    public function delete(BackupDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/backup/%s', $request->node, $request->filename),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Download a backup file.
     *
     * @param BackupDownloadRequest $request
     * @return Result
     */
    public function download(BackupDownloadRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/backup/%s', $request->node, $request->filename),
                method: 'GET',
            );

            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['content' => $data]);
    }

    /**
     * Restore the system configuration.
     *
     * @param BackupRestoreRequest $request
     * @return Result
     */
    public function restore(BackupRestoreRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/backup/%s', $request->node, $request->filename),
                method: 'POST',
                params: $request->toArray(),
            );

            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['result' => $data]);
    }
}
