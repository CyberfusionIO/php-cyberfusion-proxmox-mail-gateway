<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\QuarantineSpamMail;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineSpamRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class QuarantineSpamEndpoint extends Endpoint
{
    /**
     * Get a list of quarantined spam mails in the given timeframe for the given user.
     *
     * @param QuarantineSpamRequest $request
     * @return Result
     */
    public function getSpamMails(QuarantineSpamRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/spam',
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

        $spamMails = collect();
        foreach ($data as $item) {
            $spamMails->push(new QuarantineSpamMail(
                bytes: Arr::get($item, 'bytes'),
                envelope_sender: Arr::get($item, 'envelope_sender'),
                from: Arr::get($item, 'from'),
                id: Arr::get($item, 'id'),
                receiver: Arr::get($item, 'receiver'),
                sender: Arr::get($item, 'sender'),
                spamlevel: Arr::get($item, 'spamlevel'),
                subject: Arr::get($item, 'subject'),
                time: Arr::get($item, 'time'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'spamMails' => $spamMails,
            ],
        );
    }
}
