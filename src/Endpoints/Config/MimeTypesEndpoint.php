<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\MimeType;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class MimeTypesEndpoint extends Endpoint
{
    /**
     * Get Mime Types List
     *
     * @return Result
     */
    public function get(): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/mimetypes',
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $mimeTypes = collect();
        foreach (Arr::get($data, 'data', []) as $mimeType) {
            $mimeTypes->push(new MimeType(
                mimetype: Arr::get($mimeType, 'mimetype'),
                text: Arr::get($mimeType, 'text'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'mimeTypes' => $mimeTypes,
            ],
        );
    }
}
