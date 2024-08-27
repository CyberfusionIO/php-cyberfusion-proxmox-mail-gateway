<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\DkimSelectorItem;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class DkimSelectorsEndpoint extends Endpoint
{
    /**
     * Get a list of all existing selectors.
     *
     * @return Result
     */
    public function list(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/dkim/selectors',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $selectors = collect();
        foreach ($data as $item) {
            $selectors->push(new DkimSelectorItem(
                selector: Arr::get($item, 'selector'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'selectors' => $selectors,
            ],
        );
    }
}
