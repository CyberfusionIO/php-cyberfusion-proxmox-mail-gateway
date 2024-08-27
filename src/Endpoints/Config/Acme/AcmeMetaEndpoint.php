<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Acme;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Acme\AcmeMeta;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmeMetaGetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class AcmeMetaEndpoint
 *
 * Endpoint for retrieving ACME Directory Meta Information.
 */
class AcmeMetaEndpoint extends Endpoint
{
    /**
     * Retrieve ACME Directory Meta Information.
     *
     * @param AcmeMetaGetRequest $request
     * @return Result
     */
    public function get(AcmeMetaGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/acme/meta',
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

        return new Result(
            success: true,
            data: [
                'meta' => new AcmeMeta(
                    caaIdentities: $data['data']['caaIdentities'] ?? null,
                    externalAccountRequired: $data['data']['externalAccountRequired'] ?? null,
                    termsOfService: $data['data']['termsOfService'] ?? null,
                    website: $data['data']['website'] ?? null,
                ),
            ],
        );
    }
}
