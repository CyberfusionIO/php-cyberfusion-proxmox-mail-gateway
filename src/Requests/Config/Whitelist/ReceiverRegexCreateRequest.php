<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class ReceiverRegexCreateRequest
{
    /**
     * @param string $regex Email address regular expression.
     */
    public function __construct(
        public string $regex,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'regex' => $this->regex,
        ];
    }
}
