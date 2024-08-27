<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\ClamavConfig;
use Cyberfusion\ProxmoxMGW\Requests\Config\UpdateClamavConfigRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ClamavEndpoint extends Endpoint
{
    /**
     * Read clamav configuration properties.
     *
     * @return Result
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/clamav',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $config = new ClamavConfig(
            archiveblockencrypted: Arr::get($data, 'data.archiveblockencrypted'),
            archivemaxfiles: Arr::get($data, 'data.archivemaxfiles'),
            archivemaxrec: Arr::get($data, 'data.archivemaxrec'),
            archivemaxsize: Arr::get($data, 'data.archivemaxsize'),
            dbmirror: Arr::get($data, 'data.dbmirror'),
            maxcccount: Arr::get($data, 'data.maxcccount'),
            maxscansize: Arr::get($data, 'data.maxscansize'),
            safebrowsing: Arr::get($data, 'data.safebrowsing'),
            scriptedupdates: Arr::get($data, 'data.scriptedupdates'),
        );

        return new Result(
            success: true,
            data: [
                'config' => $config,
            ],
        );
    }

    /**
     * Update clamav configuration properties.
     *
     * @param UpdateClamavConfigRequest $request
     * @return Result
     */
    public function update(UpdateClamavConfigRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/clamav',
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
