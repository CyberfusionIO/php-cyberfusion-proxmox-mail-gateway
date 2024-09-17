<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\PbsJob;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\PbsListRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class PbsEndpoint extends Endpoint
{
    /**
     * List all configured Proxmox Backup Server jobs.
     *
     * @param PbsListRequest $request
     * @return Result
     */
    public function list(PbsListRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/pbs', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $pbsJobs = collect();
        foreach (Arr::get($data, 'data', []) as $job) {
            $pbsJobs->push(new PbsJob(
                datastore: Arr::get($job, 'datastore'),
                disable: Arr::get($job, 'disable'),
                fingerprint: Arr::get($job, 'fingerprint'),
                includeStatistics: Arr::get($job, 'include-statistics'),
                keepDaily: Arr::get($job, 'keep-daily'),
                keepHourly: Arr::get($job, 'keep-hourly'),
                keepLast: Arr::get($job, 'keep-last'),
                keepMonthly: Arr::get($job, 'keep-monthly'),
                keepWeekly: Arr::get($job, 'keep-weekly'),
                keepYearly: Arr::get($job, 'keep-yearly'),
                namespace: Arr::get($job, 'namespace'),
                notify: Arr::get($job, 'notify'),
                password: Arr::get($job, 'password'),
                port: Arr::get($job, 'port'),
                remote: Arr::get($job, 'remote'),
                server: Arr::get($job, 'server'),
                username: Arr::get($job, 'username'),
            ));
        }

        return new Result(success: true, data: ['pbsJobs' => $pbsJobs]);
    }
}
