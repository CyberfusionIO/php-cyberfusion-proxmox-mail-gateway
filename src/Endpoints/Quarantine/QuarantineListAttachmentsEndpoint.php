<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\QuarantineAttachmentDetails;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineListAttachmentsRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

/**
 * Class QuarantineListAttachmentsEndpoint
 *
 * This class handles operations related to listing attachments for emails in the quarantine of the Proxmox Mail Gateway.
 */
class QuarantineListAttachmentsEndpoint extends Endpoint
{
    /**
     * Get Attachments for E-Mail in Quarantine.
     *
     * @param QuarantineListAttachmentsRequest $request The request object containing query parameters.
     * @return Result The result object containing the list of attachments or error information.
     */
    public function list(QuarantineListAttachmentsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/listattachments',
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

        $attachments = collect();
        foreach ($data as $item) {
            $attachments->push(new QuarantineAttachmentDetails(
                contentType: Arr::get($item, 'content-type'),
                id: Arr::get($item, 'id'),
                name: Arr::get($item, 'name'),
                size: Arr::get($item, 'size'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'attachments' => $attachments,
            ],
        );
    }
}
