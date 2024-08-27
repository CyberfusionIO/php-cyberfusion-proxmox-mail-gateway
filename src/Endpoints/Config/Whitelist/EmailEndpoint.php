<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Whitelist\Email;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\EmailGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\EmailUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class EmailEndpoint extends Endpoint
{
    /**
     * Read 'Mail address' object settings.
     *
     * @param EmailGetRequest $request
     * @return Result
     */
    public function get(EmailGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                sprintf('/config/whitelist/email/%d', $request->id),
                'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'email' => new Email(
                    id: Arr::get($data, 'id'),
                    email: Arr::get($data, 'email'),
                ),
            ],
        );
    }

    /**
     * Update 'Mail address' object.
     *
     * @param EmailUpdateRequest $request
     * @return Result
     */
    public function update(EmailUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                sprintf('/config/whitelist/email/%d', $request->id),
                'PUT',
                [
                    'email' => $request->email,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
