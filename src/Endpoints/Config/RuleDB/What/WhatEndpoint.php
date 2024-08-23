<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\What;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\What\ContentType;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\What\ContentTypeCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\What\ContentTypeGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\What\ContentTypeUpdateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\What\DeleteObjectRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class WhatEndpoint extends Endpoint
{
    /**
     * Remove an object from the 'what' group.
     *
     * @param DeleteObjectRequest $request
     * @return Result
     */
    public function deleteObject(DeleteObjectRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/objects/%d', $request->ogroup, $request->id),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Add 'ContentType Filter' object.
     *
     * @param ContentTypeCreateRequest $request
     * @return Result
     */
    public function createContentType(ContentTypeCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/contenttype', $request->ogroup),
                method: 'POST',
                params: [
                    'contenttype' => $request->contenttype,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'id' => Arr::get($data, 'data'),
            ],
        );
    }

    /**
     * Read 'ContentType Filter' object settings.
     *
     * @param ContentTypeGetRequest $request
     * @return Result
     */
    public function getContentType(ContentTypeGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/contenttype/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'contentType' => new ContentType(
                    id: Arr::get($data, 'data.id'),
                    contenttype: Arr::get($data, 'data.contenttype'),
                ),
            ],
        );
    }

    /**
     * Update 'ContentType Filter' object.
     *
     * @param ContentTypeUpdateRequest $request
     * @return Result
     */
    public function updateContentType(ContentTypeUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/what/%d/contenttype/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: [
                    'contenttype' => $request->contenttype,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
