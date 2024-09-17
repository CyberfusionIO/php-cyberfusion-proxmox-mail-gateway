<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\VncWebSocketRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class VncWebSocketEndpoint extends Endpoint
{
    /**
     * Opens a websocket for VNC traffic.
     *
     * @param VncWebSocketRequest $request
     * @return Result
     */
    public function get(VncWebSocketRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/vncwebsocket', $request->node),
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
                'port' => $data['port'],
            ],
        );
    }
}
