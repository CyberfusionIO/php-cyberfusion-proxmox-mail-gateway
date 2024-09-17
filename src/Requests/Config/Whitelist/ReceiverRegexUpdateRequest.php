<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist;

class ReceiverRegexUpdateRequest
{
    /**
     * @param int $id Object ID.
     * @param string $regex Email address regular expression.
     */
    public function __construct(
        public int $id,
        public string $regex,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'regex' => $this->regex,
        ];
    }
}
