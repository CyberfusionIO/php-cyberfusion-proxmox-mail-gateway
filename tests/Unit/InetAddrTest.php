<?php

namespace YWatchman\ProxmoxMGW\Tests\Unit;

use YWatchman\ProxmoxMGW\Exceptions\InetAddrValidationException;
use YWatchman\ProxmoxMGW\Support\InetAddr;
use YWatchman\ProxmoxMGW\Tests\TestCase;

class InetAddrTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_validate_cidr(): void
    {
        $inetAddr = new InetAddr('185.233.172.16/24');
        $this->assertTrue($inetAddr->isCidr(false));

        $inetAddr = new InetAddr('2a0c:eb00:0:f7:185:233:172:16/128');
        $this->assertTrue($inetAddr->isCidr(false));

        $inetAddr = new InetAddr('185.233.172.16//32');
        $this->assertFalse($inetAddr->isCidr(false));
    }

    public function test_cidr_validation_throws_exception()
    {
        $inetAddr = new InetAddr('185.233.172.16//24');
        $this->expectExceptionCode(InetAddrValidationException::CIDR_TOO_MANY_SLASHES);
        $inetAddr->isCidr();
    }
}
