<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Ldap\LdapProfile;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ldap\LdapCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ldap\LdapDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ldap\LdapGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Ldap\LdapUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class LdapEndpoint extends Endpoint
{
    /**
     * List configured LDAP profiles.
     *
     * @return Result
     */
    public function index(): Result
    {
        try {
            $response = $this->client->makeRequest('/config/ldap');
            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $profiles = collect();
        foreach (Arr::get($data, 'data', []) as $profile) {
            $profiles->push(new LdapProfile(
                profile: Arr::get($profile, 'profile'),
                server1: Arr::get($profile, 'server1'),
                mode: Arr::get($profile, 'mode'),
                comment: Arr::get($profile, 'comment'),
                disable: Arr::get($profile, 'disable'),
                gcount: Arr::get($profile, 'gcount'),
                mcount: Arr::get($profile, 'mcount'),
                server2: Arr::get($profile, 'server2'),
                ucount: Arr::get($profile, 'ucount'),
            ));
        }

        return new Result(success: true, data: ['profiles' => $profiles]);
    }

    /**
     * Add LDAP profile.
     *
     * @param LdapCreateRequest $request
     * @return Result
     */
    public function create(LdapCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest('/config/ldap', 'POST', $request->toArray());
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Delete an LDAP profile.
     *
     * @param LdapDeleteRequest $request
     * @return Result
     */
    public function delete(LdapDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(sprintf('/config/ldap/%s', $request->profile), 'DELETE');
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Get LDAP profile configuration.
     *
     * @param LdapGetRequest $request
     * @return Result
     */
    public function get(LdapGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(sprintf('/config/ldap/%s/config', $request->profile));
            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        $profile = new LdapProfile(
            profile: Arr::get($data, 'data.profile'),
            server1: Arr::get($data, 'data.server1'),
            mode: Arr::get($data, 'data.mode'),
            comment: Arr::get($data, 'data.comment'),
            disable: Arr::get($data, 'data.disable'),
            accountattr: Arr::get($data, 'data.accountattr'),
            basedn: Arr::get($data, 'data.basedn'),
            binddn: Arr::get($data, 'data.binddn'),
            bindpw: Arr::get($data, 'data.bindpw'),
            cafile: Arr::get($data, 'data.cafile'),
            filter: Arr::get($data, 'data.filter'),
            groupbasedn: Arr::get($data, 'data.groupbasedn'),
            groupclass: Arr::get($data, 'data.groupclass'),
            mailattr: Arr::get($data, 'data.mailattr'),
            port: Arr::get($data, 'data.port'),
            server2: Arr::get($data, 'data.server2'),
            verify: Arr::get($data, 'data.verify'),
        );

        return new Result(success: true, data: ['profile' => $profile]);
    }

    /**
     * Update LDAP profile settings.
     *
     * @param LdapUpdateRequest $request
     * @return Result
     */
    public function update(LdapUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(sprintf('/config/ldap/%s/config', $request->profile), 'PUT', $request->toArray());
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
