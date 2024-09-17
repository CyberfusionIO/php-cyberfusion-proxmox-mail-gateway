<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\PbsInstance;
use Cyberfusion\ProxmoxMGW\Requests\Config\PbsCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class PbsEndpoint extends Endpoint
{
    /**
     * List all configured Proxmox Backup Server instances.
     *
     * @return Result
     */
    public function list(): Result
    {
        try {
            $response = $this->client->makeRequest('/config/pbs');
            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $instances = collect();
        foreach (Arr::get($data, 'data', []) as $instance) {
            $instances->push(new PbsInstance(
                remote: Arr::get($instance, 'remote'),
                server: Arr::get($instance, 'server'),
                datastore: Arr::get($instance, 'datastore'),
                fingerprint: Arr::get($instance, 'fingerprint'),
                port: Arr::get($instance, 'port'),
                username: Arr::get($instance, 'username'),
                namespace: Arr::get($instance, 'namespace'),
                notify: Arr::get($instance, 'notify'),
                keepDaily: Arr::get($instance, 'keep-daily'),
                keepHourly: Arr::get($instance, 'keep-hourly'),
                keepLast: Arr::get($instance, 'keep-last'),
                keepMonthly: Arr::get($instance, 'keep-monthly'),
                keepWeekly: Arr::get($instance, 'keep-weekly'),
                keepYearly: Arr::get($instance, 'keep-yearly'),
                disable: Arr::get($instance, 'disable'),
                includeStatistics: Arr::get($instance, 'include-statistics'),
            ));
        }

        return new Result(success: true, data: ['instances' => $instances]);
    }

    /**
     * Add Proxmox Backup Server remote instance.
     *
     * @param PbsCreateRequest $request
     * @return Result
     */
    public function create(PbsCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/pbs',
                method: 'POST',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
