<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\SpamassassinRuleStatus;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\SpamassassinRulesRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class SpamassassinEndpoint extends Endpoint
{
    /**
     * Get SpamAssassin rules status.
     *
     * @param SpamassassinRulesRequest $request
     * @return Result
     */
    public function getRulesStatus(SpamassassinRulesRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: "/nodes/{$request->node}/spamassassin/rules",
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $statuses = collect();
        foreach ($data as $item) {
            $statuses->push(new SpamassassinRuleStatus(
                channel: Arr::get($item, 'channel'),
                last_updated: Arr::get($item, 'last_updated'),
                update_avail: Arr::get($item, 'update_avail'),
                update_version: Arr::get($item, 'update_version'),
                version: Arr::get($item, 'version'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'statuses' => $statuses,
            ],
        );
    }

    /**
     * Update SpamAssassin rules.
     *
     * @param SpamassassinRulesRequest $request
     * @return Result
     */
    public function updateRules(SpamassassinRulesRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: "/nodes/{$request->node}/spamassassin/rules",
                method: 'POST',
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
                'result' => $data,
            ],
        );
    }
}
