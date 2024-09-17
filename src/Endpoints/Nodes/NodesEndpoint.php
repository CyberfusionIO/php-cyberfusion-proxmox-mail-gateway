<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Node;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\NodesIndexRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class NodesEndpoint extends Endpoint
{
    /**
     * Cluster node index.
     *
     * @param NodesIndexRequest $request
     * @return Result
     */
    public function index(NodesIndexRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/nodes',
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

        $nodes = collect();
        foreach (Arr::get($data, 'data', []) as $nodeData) {
            $nodes->push(new Node($nodeData));
        }

        return new Result(
            success: true,
            data: [
                'nodes' => $nodes,
            ],
        );
    }

    /**
     * Node index.
     *
     * @param string $node The cluster node name.
     * @return Result
     */
    public function nodeIndex(string $node): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: "/nodes/{$node}",
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $nodeItems = collect();
        foreach (Arr::get($data, 'data', []) as $itemData) {
            $nodeItems->push($itemData);
        }

        return new Result(
            success: true,
            data: [
                'nodeItems' => $nodeItems,
            ],
        );
    }
}
