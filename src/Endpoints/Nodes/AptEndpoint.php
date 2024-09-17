<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\AptIndexItem;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\AptIndexRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class AptEndpoint extends Endpoint
{
    /**
     * Directory index for apt (Advanced Package Tool).
     *
     * @param AptIndexRequest $request
     * @return Result
     */
    public function index(AptIndexRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/apt', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $items = array_map(fn($item) => new AptIndexItem($item), $data);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: ['items' => $items],
        );
    }
}
