<?php


namespace YWatchman\ProxmoxMGW\Support;

use YWatchman\ProxmoxMGW\Exceptions\InetAddrValidationException;

class InetAddr
{

    /** @var string CIDR */
    protected $addr;

    /** @var string Prefix */
    protected $prefix;

    /** @var int Netmask */
    protected $netmask;

    /**
     * InetAddr constructor.
     * @param $addr
     * @param null $netmask
     */
    public function __construct($addr, $netmask = null)
    {
        $this->addr = $addr;

        try {
            if ($this->isCidr()) {
                list($this->prefix, $this->netmask) = $this->getNetmaskAndPrefix();
            }
        } catch (InetAddrValidationException $e) {
            $this->prefix = $addr;
            $this->netmask = $netmask;
        }
    }

    /**
     * Returns the netmask.
     *
     * @return mixed
     */
    public function getNetmaskAndPrefix()
    {
        return explode('/', $this->addr);
    }

    /**
     * Check if supplied address is a cidr.
     *
     * @param bool $exceptions
     * @return bool
     * @throws InetAddrValidationException
     */
    public function isCidr($exceptions = true)
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
     *
     * @return bool
     */
    public function isV6()
    {
        return filter_var($this->prefix, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    /**
     * Check if supplied address is an IPv4 Address.
     *
     * @return mixed
     */
    public function isV4()
    {
        return filter_var($this->prefix, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Validate CIDR length.
     *
     * @return bool
     * @throws InetAddrValidationException
     */
    public function validateCidr()
    {
        if ($this->netmask < 0 || $this->netmask > 128) {
            throw new InetAddrValidationException(
                'Invalid Cidr.',
                InetAddrValidationException::CIDR_INVALID
            );
        }

        if ($this->isV6()) {
            return $this->netmask <= 128;
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
