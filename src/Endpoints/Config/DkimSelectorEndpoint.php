<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\DkimSelector;
use Cyberfusion\ProxmoxMGW\Requests\DkimSelectorGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\DkimSelectorSetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DkimSelectorEndpoint extends Endpoint
{
    /**
     * Get the public key for the configured selector, prepared as DKIM TXT record.
     *
     * @param DkimSelectorGetRequest $request
     * @return Result
     */
    public function get(DkimSelectorGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/dkim/selector',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'dkimSelector' => new DkimSelector(
                    keysize: Arr::get($data, 'keysize'),
                    record: Arr::get($data, 'record'),
                    selector: Arr::get($data, 'selector'),
                ),
            ],
        );
    }

    /**
     * Generate a new private key for selector. All future mail will be signed with the new key!
     *
     * @param DkimSelectorSetRequest $request
     * @return Result
     */
    public function set(DkimSelectorSetRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/dkim/selector',
                method: 'POST',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
