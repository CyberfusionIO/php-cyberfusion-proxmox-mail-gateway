<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineSendLinkRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class QuarantineSendLinkEndpoint extends Endpoint
{
    /**
     * Send Quarantine link to given e-mail.
     *
     * @param QuarantineSendLinkRequest $request
     * @return Result
     */
    public function sendLink(QuarantineSendLinkRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/quarantine/sendlink',
                method: 'POST',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }
}
