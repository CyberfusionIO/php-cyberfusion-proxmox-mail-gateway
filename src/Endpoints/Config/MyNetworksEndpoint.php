<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Network;
use Cyberfusion\ProxmoxMGW\Requests\MyNetworksCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\MyNetworksDeleteRequest;
use Cyberfusion\ProxmoxMGW\Support\InetAddr;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class MyNetworksEndpoint extends Endpoint
{
    public function get(): Result
    {
        try {
            $response = $this
                    ->client
                    ->makeRequest(
                        endpoint: '/config/mynetworks',
                    );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $networks = collect();
        foreach (Arr::get($data, 'data', []) as $network) {
            $networks->push(new Network(
                size   : Arr::get($network, 'prefix_size'),
                comment: Arr::get($network, 'comment'),
                prefix : Arr::get($network, 'network_address'),
                cidr   : Arr::get($network, 'cidr'),
            ));
        }

        return new Result(
            success: true,
            data   : [
                'networks' => $networks,
            ],
        );
    }

    public function create(MyNetworksCreateRequest $request): Result
    {
        try {
            (new InetAddr($request->cidr))->validateCidr();
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        try {
            $this
                    ->client
                    ->makeRequest(
                        endpoint: '/config/mynetworks',
                        method  : 'POST',
                        params  : [
                            'cidr'    => $request->cidr,
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

    public function delete(MyNetworksDeleteRequest $request): Result
    {
        try {
            (new InetAddr($request->cidr))->validateCidr();
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        try {
            $this
                    ->client
                    ->makeRequest(
                        endpoint: sprintf('/config/mynetworks/%s', $request->cidr),
                        method  : 'DELETE',
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
