<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Node\PBS;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Node\PBS\RemoteIndexRequest;
use Cyberfusion\ProxmoxMGW\Models\Node\PBS\RemoteSection;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class RemoteEndpoint extends Endpoint
{
    /**
     * Backup Job index.
     *
     * @param RemoteIndexRequest $request
     * @return Result
     */
    public function index(RemoteIndexRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                sprintf('/nodes/%s/pbs/%s', $request->node, $request->remote),
                'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $sections = collect();
        foreach (Arr::get($data, 'data', []) as $section) {
            $sections->push(new RemoteSection(
                section: Arr::get($section, 'section'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'sections' => $sections,
            ],
        );
    }
}
