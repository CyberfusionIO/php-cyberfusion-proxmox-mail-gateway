<?php

namespace YWatchman\ProxmoxMGW\Exceptions;

use Exception;

abstract class ProxmoxException extends Exception
{
    public const CIDR_CANNOT_FIND_ADDRESS = 100;

    public const CIDR_INVALID = 101;

    public const CIDR_TOO_MANY_SLASHES = 102;

    public const AUTH_MISSING_CREDENTIALS = 200;

    public const GATEWAY_METHOD_NOT_IMPLEMENTED = 300;
}
