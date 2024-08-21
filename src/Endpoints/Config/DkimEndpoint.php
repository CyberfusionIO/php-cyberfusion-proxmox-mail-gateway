<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\DkimDomainData;
use Cyberfusion\ProxmoxMGW\Requests\DkimCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\DkimDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\DkimGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\DkimUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DkimEndpoint extends Endpoint
{
    public function get(DkimGetRequest $request): Result
    {
        try {
            $response = $this
                ->client
                ->makeRequest(
                    endpoint: '/config/dkim/domains',
                    params: [
                        'domain' => $request->domain,
                    ],
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
                'dkimDomainData' => new DkimDomainData(
                    domain: Arr::get($data, 'data.domain'),
                    comment: Arr::get($data, 'data.comment'),
                ),
            ],
        );
    }

    public function create(DkimCreateRequest $request): Result
    {
        try {
            $this
                ->client
                ->makeRequest(
                    endpoint: '/config/dkim/domains',
                    method: 'POST',
                    params: [
                        'domain' => $request->domain,
                        'comment' => $request->comment,
                    ],
                );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }

    public function update(DkimUpdateRequest $request): Result
    {
        try {
            $this
                ->client
                ->makeRequest(
                    endpoint: sprintf('/config/dkim/domains/%s', $request->domain),
                    method: 'PUT',
                    params: [
                        'domain' => $request->domain,
                        'comment' => $request->comment,
                    ],
                );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }

    public function delete(DkimDeleteRequest $request): Result
    {
        try {
            $this
                ->client
                ->makeRequest(
                    endpoint: sprintf('/config/dkim/domains/%s', $request->domain),
                    method: 'DELETE',
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
