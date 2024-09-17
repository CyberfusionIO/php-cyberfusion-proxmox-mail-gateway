<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Quarantine;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\QuarantineDownloadRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class QuarantineDownloadEndpoint
 *
 * This class handles operations related to downloading emails or attachments from the quarantine in the Proxmox Mail Gateway.
 */
class QuarantineDownloadEndpoint extends Endpoint
{
    /**
     * Download E-Mail or Attachment from Quarantine.
     *
     * @param QuarantineDownloadRequest $request The request object containing query parameters.
     * @return Result The result object containing the download data or error information.
     */
    public function download(QuarantineDownloadRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/quarantine/download',
                method: 'GET',
                params: $request->toArray(),
            );

            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'content' => $data,
            ],
        );
    }
}
