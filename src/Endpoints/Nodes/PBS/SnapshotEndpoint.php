<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\PBS;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\PBS\Snapshot;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\PBS\GetGroupSnapshotsRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\PBS\GetSnapshotsRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\PBS\RunBackupRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class SnapshotEndpoint extends Endpoint
{
    /**
     * Get snapshots stored on remote.
     *
     * @param GetSnapshotsRequest $request
     * @return Result
     */
    public function getSnapshots(GetSnapshotsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                sprintf('/nodes/%s/pbs/%s/snapshot', $request->node, $request->remote),
                'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $snapshots = collect();
        foreach (Arr::get($data, 'data', []) as $snapshot) {
            $snapshots->push(new Snapshot(
                backupId: Arr::get($snapshot, 'backup-id'),
                backupTime: Arr::get($snapshot, 'backup-time'),
                ctime: Arr::get($snapshot, 'ctime'),
                size: Arr::get($snapshot, 'size'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'snapshots' => $snapshots,
            ],
        );
    }

    /**
     * Create a new backup and prune the backup group afterwards, if configured.
     *
     * @param RunBackupRequest $request
     * @return Result
     */
    public function runBackup(RunBackupRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                sprintf('/nodes/%s/pbs/%s/snapshot', $request->node, $request->remote),
                'POST',
                $request->toArray(),
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
                'result' => Arr::get($data, 'data'),
            ],
        );
    }

    /**
     * Get snapshots from a specific ID stored on remote.
     *
     * @param GetGroupSnapshotsRequest $request
     * @return Result
     */
    public function getGroupSnapshots(GetGroupSnapshotsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                sprintf('/nodes/%s/pbs/%s/snapshot/%s', $request->node, $request->remote, $request->backupId),
                'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $snapshots = collect();
        foreach (Arr::get($data, 'data', []) as $snapshot) {
            $snapshots->push(new Snapshot(
                backupId: Arr::get($snapshot, 'backup-id'),
                backupTime: Arr::get($snapshot, 'backup-time'),
                ctime: Arr::get($snapshot, 'ctime'),
                size: Arr::get($snapshot, 'size'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'snapshots' => $snapshots,
            ],
        );
    }
}
