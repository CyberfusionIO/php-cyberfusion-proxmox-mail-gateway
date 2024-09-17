<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\CustomScore;
use Cyberfusion\ProxmoxMGW\Requests\Config\CustomScoreCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\CustomScoreDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\CustomScoreEditRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\CustomScoreGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\CustomScoreApplyChangesRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class CustomScoresEndpoint extends Endpoint
{
    /**
     * List custom scores.
     *
     * @return Result
     */
    public function list(): Result
    {
        try {
            $response = $this->client->makeRequest('/config/customscores');
            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $scores = collect();
        foreach (Arr::get($data, 'data', []) as $score) {
            $scores->push(new CustomScore(
                name: Arr::get($score, 'name'),
                score: Arr::get($score, 'score'),
                comment: Arr::get($score, 'comment'),
                digest: Arr::get($score, 'digest'),
            ));
        }

        return new Result(success: true, data: ['scores' => $scores]);
    }

    /**
     * Create custom SpamAssassin score.
     *
     * @param CustomScoreCreateRequest $request
     * @return Result
     */
    public function create(CustomScoreCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/customscores',
                method: 'POST',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Apply custom score changes.
     *
     * @param CustomScoreApplyChangesRequest $request
     * @return Result
     */
    public function applyChanges(CustomScoreApplyChangesRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/customscores',
                method: 'PUT',
                params: $request->toArray(),
            );
            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['result' => $data]);
    }

    /**
     * Revert custom score changes.
     *
     * @return Result
     */
    public function revertChanges(): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/customscores',
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Get custom SpamAssassin score.
     *
     * @param CustomScoreGetRequest $request
     * @return Result
     */
    public function get(CustomScoreGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/customscores/%s', $request->name),
            );
            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $score = new CustomScore(
            name: Arr::get($data, 'name'),
            score: Arr::get($data, 'score'),
            comment: Arr::get($data, 'comment'),
        );

        return new Result(success: true, data: ['score' => $score]);
    }

    /**
     * Edit custom SpamAssassin score.
     *
     * @param CustomScoreEditRequest $request
     * @return Result
     */
    public function edit(CustomScoreEditRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/customscores/%s', $request->name),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Delete custom SpamAssassin score.
     *
     * @param CustomScoreDeleteRequest $request
     * @return Result
     */
    public function delete(CustomScoreDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/customscores/%s', $request->name),
                method: 'DELETE',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
