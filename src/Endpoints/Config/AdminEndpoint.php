<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\AdminConfiguration;
use Cyberfusion\ProxmoxMGW\Requests\AdminGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\AdminUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class AdminEndpoint extends Endpoint
{
    /**
     * Read admin configuration properties.
     *
     * @param AdminGetRequest $request
     * @return Result
     */
    public function get(AdminGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/admin',
                method: 'GET',
                params: $request->toArray(),
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
                'adminConfiguration' => new AdminConfiguration(
                    advfilter: Arr::get($data, 'advfilter'),
                    avast: Arr::get($data, 'avast'),
                    clamav: Arr::get($data, 'clamav'),
                    custom_check: Arr::get($data, 'custom_check'),
                    custom_check_path: Arr::get($data, 'custom_check_path'),
                    dailyreport: Arr::get($data, 'dailyreport'),
                    demo: Arr::get($data, 'demo'),
                    dkim_use_domain: Arr::get($data, 'dkim-use-domain'),
                    dkim_selector: Arr::get($data, 'dkim_selector'),
                    dkim_sign: Arr::get($data, 'dkim_sign'),
                    dkim_sign_all_mail: Arr::get($data, 'dkim_sign_all_mail'),
                    email: Arr::get($data, 'email'),
                    http_proxy: Arr::get($data, 'http_proxy'),
                    statlifetime: Arr::get($data, 'statlifetime'),
                ),
            ],
        );
    }

    /**
     * Update admin configuration properties.
     *
     * @param AdminUpdateRequest $request
     * @return Result
     */
    public function update(AdminUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/admin',
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
