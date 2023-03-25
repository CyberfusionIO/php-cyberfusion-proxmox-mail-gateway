<?php

namespace YWatchman\ProxmoxMGW;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use YWatchman\ProxmoxMGW\Exceptions\AuthenticationException;
use YWatchman\ProxmoxMGW\Exceptions\InvalidRequestException;
use YWatchman\ProxmoxMGW\Requests\Access;

class Client
{
    /**
     * PMG hostname
     */
    protected string $hostname;

    /**
     * PMG Port
     */
    protected int $port;

    /**
     * PMG username
     */
    protected string $username;

    /**
     * PMG Password
     */
    protected string $password;

    /**
     * Access request object for retrieving tokens etc.
     */
    protected ?Access $access = null;

    /**
     * Authentication realm
     */
    protected string $realm;

    /**
     * Login cookie from PMG
     */
    protected string $ticket = '';

    /**
     * Protection token retrieved from API
     */
    protected string $csrf = '';

    /**
     * Can be json or extjs
     */
    protected string $responseType = 'json';

    protected Client $client;

    protected HttpClient $httpClient;

    /**
     * Gateway constructor.
     *
     * @throws AuthenticationException
     */
    public function __construct(
        string $hostname,
        string $username,
        string $password,
        string $realm = 'pam',
        int $port = 8006,
        string $userAgent = 'Cyberfusion-PMG-PHP/1.0'
    ) {
        if (empty($username) || empty($password)) {
            // Throw exception if username or password is empty
            throw new AuthenticationException(
                'Missing username or password',
                AuthenticationException::AUTH_MISSING_CREDENTIALS
            );
        }
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->realm = $realm;
        $this->port = $port;

        $this->httpClient = new HttpClient([
            'headers' => [
                'User-Agent' => $userAgent,
            ],
        ]);
        $this->client = $this;
    }

    public function getTicket(): string
    {
        return $this->ticket;
    }

    protected function setTicket(string $ticket): void
    {
        $this->ticket = $ticket;
    }

    public function getCsrf(): string
    {
        return $this->csrf;
    }

    protected function setCsrf(string $csrf): void
    {
        $this->csrf = $csrf;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRealm(): string
    {
        return $this->realm;
    }

    private function getAccess(): Access
    {
        // Set access and return it.
        return $this->access ?: ($this->access = new Access($this->client));
    }

    public function setAccess(): void
    {
        $this->getAccess();
        $this->access->getTicket();

        $this->setTicket($this->access->ticket);
        $this->setCsrf($this->access->csrf);
    }

    /**
     * Execute http request.
     *
     * @throws InvalidRequestException|GuzzleException
     */
    public function makeRequest(string $endpoint, string $method = 'GET', array $params = []): ResponseInterface
    {
        // Get API url and append endpoint
        $url = $this->getRequestUrl($endpoint);

        // Initialise variables for later use
        $headers = null;

        $cookieJar = new CookieJar();
        if (! empty($this->ticket)) {
            $cookieJar = CookieJar::fromArray(
                [
                    'PMGAuthCookie' => $this->ticket,
                ],
                $this->hostname
            );

            $headers = ['CSRFPreventionToken' => $this->csrf];
        }

        $params = array_filter($params, function ($value) {
            return $value !== null;
        });

        $options = [
            'verify' => false, // Todo: check debug
            'exceptions' => false,
            'cookies' => $cookieJar,
            'headers' => $headers,
            'query' => $params,
        ];

        switch ($method) {
            case 'GET':
                return $this->httpClient->get($url, $options);
            case 'POST':
                return $this->httpClient->post($url, $options);
            case 'PUT':
                return $this->httpClient->put($url, $options);
            case 'DELETE':
                return $this->httpClient->delete($url, $options);
        }

        throw new InvalidRequestException(
            'Request method is not implemented (yet).',
            InvalidRequestException::GATEWAY_METHOD_NOT_IMPLEMENTED
        );
    }

    /**
     * Get API url.
     */
    protected function getRequestUrl(string $endpoint): string
    {
        return sprintf(
            'https://%s:%d/api2/%s%s',
            $this->hostname,
            $this->port,
            $this->responseType,
            $endpoint
        );
    }
}
