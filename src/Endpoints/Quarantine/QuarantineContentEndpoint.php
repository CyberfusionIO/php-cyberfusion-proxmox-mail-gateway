<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\QuarantineContent;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineContentGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineContentActionRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Class QuarantineContentEndpoint
 *
 * This class handles operations related to quarantined email content in the Proxmox Mail Gateway.
 */
class QuarantineContentEndpoint extends Endpoint
{
    /**
     * Get email data.
     *
     * @param QuarantineContentGetRequest $request The request object containing query parameters.
     * @return Result The result object containing the email data or error information.
     */
    public function get(QuarantineContentGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/content',
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

        $quarantineContent = new QuarantineContent(
            bytes: Arr::get($data, 'bytes'),
            content: Arr::get($data, 'content'),
            envelope_sender: Arr::get($data, 'envelope_sender'),
            from: Arr::get($data, 'from'),
            header: Arr::get($data, 'header'),
            id: Arr::get($data, 'id'),
            receiver: Arr::get($data, 'receiver'),
            sender: Arr::get($data, 'sender'),
            spaminfo: Arr::get($data, 'spaminfo', []),
            spamlevel: Arr::get($data, 'spamlevel'),
            subject: Arr::get($data, 'subject'),
            time: Arr::get($data, 'time'),
        );

        return new Result(
            success: true,
            data: [
                'quarantineContent' => $quarantineContent,
            ],
        );
    }

    /**
     * Execute quarantine actions.
     *
     * @param QuarantineContentActionRequest $request The request object containing the action and email IDs.
     * @return Result The result object indicating success or failure.
     */
    public function executeAction(QuarantineContentActionRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/quarantine/content',
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
