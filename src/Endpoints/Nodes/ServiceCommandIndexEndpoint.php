<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ServiceCommandIndexRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\ServiceCommand;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ServiceCommandIndexEndpoint extends Endpoint
{
    /**
     * Get the service command index.
     *
     * @param ServiceCommandIndexRequest $request
     * @return Result
     */
    public function get(ServiceCommandIndexRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/services/%s', $request->node, $request->service),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $commands = collect();
        foreach (Arr::get($data, 'data', []) as $command) {
            $commands->push(new ServiceCommand(
                subdir: Arr::get($command, 'subdir'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'commands' => $commands,
            ],
        );
    }
}
