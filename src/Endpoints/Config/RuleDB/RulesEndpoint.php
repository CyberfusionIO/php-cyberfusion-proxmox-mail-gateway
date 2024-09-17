<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\DeleteToGroupRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class RulesEndpoint extends Endpoint
{
    /**
     * Delete group from 'to' list.
     *
     * @param DeleteToGroupRequest $request
     * @return Result
     */
    public function deleteToGroup(DeleteToGroupRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/to/%d', $request->id, $request->ogroup),
                method: 'DELETE',
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
