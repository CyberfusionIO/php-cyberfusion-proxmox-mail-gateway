<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class RegextestRequest
{
    /**
     * @param string $regex The Regex to test
     * @param string $text The String to test
     */
    public function __construct(
        public string $regex,
        public string $text,
    ) {
    }

    public function toArray(): array
    {
        return [
            'regex' => $this->regex,
            'text' => $this->text,
        ];
    }
}
