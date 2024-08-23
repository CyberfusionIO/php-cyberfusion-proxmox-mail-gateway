<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\QuarantineUser;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineUsersRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Class QuarantineUsersEndpoint
 *
 * This class handles operations related to listing users with whitelist/blacklist settings in the Proxmox Mail Gateway.
 */
class QuarantineUsersEndpoint extends Endpoint
{
    /**
     * Get a list of users with whitelist/blacklist settings.
     *
     * @param QuarantineUsersRequest $request The request object containing query parameters.
     * @return Result The result object containing the list of users or error information.
     */
    public function list(QuarantineUsersRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/quarusers',
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

        $users = collect();
        foreach ($data as $item) {
            $users->push(new QuarantineUser(
                mail: Arr::get($item, 'mail'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'users' => $users,
            ],
        );
    }
}
