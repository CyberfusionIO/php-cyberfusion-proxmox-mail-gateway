<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\AcmeChallengeSchemaItem;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class AcmeChallengeSchemaEndpoint extends Endpoint
{
    /**
     * Get schema of ACME challenge types.
     *
     * @return Result
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/acme/challenge-schema',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $items = collect();
        foreach (Arr::get($data, 'data', []) as $item) {
            $items->push(new AcmeChallengeSchemaItem(
                id: Arr::get($item, 'id'),
                name: Arr::get($item, 'name'),
                schema: Arr::get($item, 'schema'),
                type: Arr::get($item, 'type'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'items' => $items,
            ],
        );
    }
}
