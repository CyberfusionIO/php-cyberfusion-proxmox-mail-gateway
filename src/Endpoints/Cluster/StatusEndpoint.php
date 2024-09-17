<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Cluster;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Cluster\Node;
use Cyberfusion\ProxmoxMGW\Requests\Cluster\StatusGetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class StatusEndpoint extends Endpoint
{
    /**
     * Cluster node status.
     *
     * @param StatusGetRequest $request
     * @return Result
     */
    public function get(StatusGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/cluster/status',
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $nodes = collect();
        foreach ($data as $nodeData) {
            $nodes->push(new Node(
                cid: Arr::get($nodeData, 'cid'),
                fingerprint: Arr::get($nodeData, 'fingerprint'),
                hostrsapubkey: Arr::get($nodeData, 'hostrsapubkey'),
                ip: Arr::get($nodeData, 'ip'),
                name: Arr::get($nodeData, 'name'),
                rootrsapubkey: Arr::get($nodeData, 'rootrsapubkey'),
                type: Arr::get($nodeData, 'type'),
            ));
        }

        return new Result(success: true, data: ['nodes' => $nodes]);
    }
}
