<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\TermProxyRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\TermProxyResponse;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class TermProxyEndpoint extends Endpoint
{
    /**
     * Creates a Terminal proxy.
     *
     * @param TermProxyRequest $request
     * @return Result
     */
    public function create(TermProxyRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/termproxy', $request->node),
                method: 'POST',
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
                'termProxy' => new TermProxyResponse(
                    port: $data['port'],
                    ticket: $data['ticket'],
                    upid: $data['upid'],
                    user: $data['user'],
                ),
            ],
        );
    }
}
