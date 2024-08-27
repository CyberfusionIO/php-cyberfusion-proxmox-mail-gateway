<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDb\Who;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDb\Who\LdapGroup;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who\LdapGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDb\Who\LdapUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class LdapEndpoint extends Endpoint
{
    /**
     * Read 'LDAP Group' object settings.
     *
     * @param LdapGetRequest $request
     * @return Result
     */
    public function get(LdapGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/ldap/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'ldapGroup' => new LdapGroup(
                    id: Arr::get($data, 'id'),
                    group: Arr::get($data, 'group'),
                    mode: Arr::get($data, 'mode'),
                    profile: Arr::get($data, 'profile'),
                ),
            ],
        );
    }

    /**
     * Update 'LDAP Group' object.
     *
     * @param LdapUpdateRequest $request
     * @return Result
     */
    public function update(LdapUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/ldap/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
