<?php

namespace Cyberfusion\ProxmoxMGW;

use Cyberfusion\ProxmoxMGW\Endpoints\Access\TicketEndpoint;
use Cyberfusion\ProxmoxMGW\Exceptions\AuthenticationException;
use Cyberfusion\ProxmoxMGW\Exceptions\InvalidRequestException;
use Cyberfusion\ProxmoxMGW\Models\AuthenticationTicket;
use Cyberfusion\ProxmoxMGW\Requests\TicketGetRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    protected ?AuthenticationTicket $authenticationTicket = null;

    protected HttpClient $httpClient;

    public function __construct(
        private readonly string $hostname,
        private readonly int $port = 8006,
        private readonly string $userAgent = 'Cyberfusion-PMG-PHP/2.0'
    ) {
        $this->httpClient = new HttpClient([
            'connect_timeout' => 5,
            'timeout' => 10,
            'headers' => [
                'User-Agent' => $this->userAgent,
            ],
        ]);
    }

    public function isAuthenticated(): bool
    {
        return $this->authenticationTicket !== null;
    }

    /**
     * @throws AuthenticationException
     */
    public function authenticate(string $username, string $password, string $realm = 'pam'): Result
    {
        $ticketEndpoint = new TicketEndpoint($this);

        $result = $ticketEndpoint->get(new TicketGetRequest(
            username: $username,
            password: $password,
            realm: $realm,
        ));
        if ($result->failed()) {
            throw new AuthenticationException(message: $result->getMessage());
        }

        $this->authenticationTicket = $result->getData('authenticationTicket');

        return $result;
    }

    /**
     * Execute http request.
     *
     * @throws InvalidRequestException|GuzzleException
     */
    public function makeRequest(string $endpoint, string $method = 'GET', array $params = []): ResponseInterface
    {
        // Get API url and append endpoint
        $url = sprintf(
            'https://%s:%d/api2/%s%s',
            $this->hostname,
            $this->port,
            'json',
            $endpoint
        );

        // Initialise variables for later use
        $headers = null;

        $cookieJar = new CookieJar();
        if ($this->authenticationTicket !== null) {
            $cookieJar = CookieJar::fromArray(
                cookies: ['PMGAuthCookie' => $this->authenticationTicket->ticket],
                domain: $this->hostname,
            );

            $headers = ['CSRFPreventionToken' => $this->authenticationTicket->csrf];
        }

        $options = [
            'verify' => false, // Todo: check debug
            'exceptions' => false,
            'cookies' => $cookieJar,
            'headers' => $headers,
            'query' => array_filter($params, fn ($value) => $value !== null),
        ];

        // Execute the request
        return match ($method) {
            'GET' => $this->httpClient->get($url, $options),
            'POST' => $this->httpClient->post($url, $options),
            'PUT' => $this->httpClient->put($url, $options),
            'DELETE' => $this->httpClient->delete($url, $options),
            default => throw new InvalidRequestException(
                'Request method is not implemented (yet).',
                InvalidRequestException::GATEWAY_METHOD_NOT_IMPLEMENTED
            ),
        };
    }
}
