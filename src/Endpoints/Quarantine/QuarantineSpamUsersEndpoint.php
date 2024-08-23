<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\QuarantineUser;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineSpamUsersRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class QuarantineSpamUsersEndpoint extends Endpoint
{
    /**
     * Get a list of receivers of spam in the given timespan.
     *
     * @param QuarantineSpamUsersRequest $request
     * @return Result
     */
    public function getUsers(QuarantineSpamUsersRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/spamusers',
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
