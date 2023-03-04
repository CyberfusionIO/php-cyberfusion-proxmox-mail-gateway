<?php


namespace YWatchman\ProxmoxMGW\Support;

use YWatchman\ProxmoxMGW\Exceptions\InetAddrValidationException;

class InetAddr
{
    protected string $addr;
    protected string $prefix;
    protected ?int $netmask;

    public function __construct(string $addr, int $netmask = null)
    {
        $this->addr = $addr;

        try {
            if ($this->isCidr()) {
                list($this->prefix, $this->netmask) = $this->getNetmaskAndPrefix();
            }
        } catch (InetAddrValidationException) {
            $this->prefix = $addr;
            $this->netmask = $netmask;
        }
    }

    public function getNetmaskAndPrefix(): array
    {
        return explode('/', $this->addr);
    }

    /**
     * Check if supplied address is a cidr.
     *
     * @throws InetAddrValidationException
     */
    public function isCidr(bool $exceptions = true): bool
    {
        if (substr_count($this->addr, '/') == 1) {
            return true;
        }

        if ($exceptions) {
            throw new InetAddrValidationException(
                'Invalid address, too many slashes.',
                InetAddrValidationException::CIDR_TOO_MANY_SLASHES
            );
        }

        return false;
    }

    /**
     * Check if supplied address is an IPv6 Address.
     */
    public function isV6(): bool
    {
        return filter_var($this->prefix, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    /**
     * Check if supplied address is an IPv4 Address.
     */
    public function isV4(): bool
    {
        return filter_var($this->prefix, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Validate CIDR length.
     *
     * @throws InetAddrValidationException
     */
    public function validateCidr(): bool
    {
        if ($this->netmask < 0 || $this->netmask > 128) {
            throw new InetAddrValidationException(
                'Invalid Cidr.',
                InetAddrValidationException::CIDR_INVALID
            );
        }

        if ($this->isV6()) {
            return true;
        }

        if ($this->isV4()) {
            return $this->netmask <= 32;
        }

        throw new InetAddrValidationException(
            'Could not find a valid IPv4 or IPv6 Address.',
            InetAddrValidationException::CIDR_CANNOT_FIND_ADDRESS
        );
    }
}
