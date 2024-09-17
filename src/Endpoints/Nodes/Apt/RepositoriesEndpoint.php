<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Apt;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt\GetRepositoriesRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt\ChangeRepositoryRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt\AddRepositoryRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Apt\RepositoryInfo;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class RepositoriesEndpoint extends Endpoint
{
    /**
     * Get APT repository information.
     *
     * @param GetRepositoriesRequest $request
     * @return Result
     */
    public function getRepositories(GetRepositoriesRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/apt/repositories', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'repositoryInfo' => new RepositoryInfo($data),
            ],
        );
    }

    /**
     * Change the properties of a repository. Currently only allows enabling/disabling.
     *
     * @param ChangeRepositoryRequest $request
     * @return Result
     */
    public function changeRepository(ChangeRepositoryRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/apt/repositories', $request->node),
                method: 'POST',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }

    /**
     * Add a standard repository to the configuration.
     *
     * @param AddRepositoryRequest $request
     * @return Result
     */
    public function addRepository(AddRepositoryRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/apt/repositories', $request->node),
                method: 'PUT',
                params: $request->toArray(),
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
