<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\DeleteWhenGroupRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class RuleWhenEndpoint extends Endpoint
{
    /**
     * Delete group from 'when' list.
     *
     * @param DeleteWhenGroupRequest $request
     * @return Result
     */
    public function deleteWhenGroup(DeleteWhenGroupRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/rules/%d/when/%d', $request->id, $request->ogroup),
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
