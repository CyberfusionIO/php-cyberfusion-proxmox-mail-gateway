<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\RuleDB\Who;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\RuleDB\Who\LdapUser;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\LdapUserCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\LdapUserGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who\LdapUserUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class LdapUserEndpoint extends Endpoint
{
    /**
     * Add 'LDAP User' object.
     *
     * @param LdapUserCreateRequest $request
     * @return Result
     */
    public function create(LdapUserCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/ldapuser', $request->ogroup),
                method: 'POST',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['id' => $data]);
    }

    /**
     * Read 'LDAP User' object settings.
     *
     * @param LdapUserGetRequest $request
     * @return Result
     */
    public function get(LdapUserGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/ldapuser/%d', $request->ogroup, $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'ldapUser' => new LdapUser(
                    id: Arr::get($data, 'id'),
                    account: Arr::get($data, 'account'),
                    profile: Arr::get($data, 'profile'),
                ),
            ],
        );
    }

    /**
     * Update 'LDAP User' object.
     *
     * @param LdapUserUpdateRequest $request
     * @return Result
     */
    public function update(LdapUserUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/ruledb/who/%d/ldapuser/%d', $request->ogroup, $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
