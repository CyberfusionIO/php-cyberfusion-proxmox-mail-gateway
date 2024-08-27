<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Who;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\LdapCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class LdapEndpoint extends Endpoint
{
    /**
     * Add 'LDAP Group' object.
     *
     * @param LdapCreateRequest $request
     * @return Result
     */
    public function create(LdapCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/ldap', $request->ogroup),
                method: 'POST',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => Arr::get($data, 'data')]);
    }
}
