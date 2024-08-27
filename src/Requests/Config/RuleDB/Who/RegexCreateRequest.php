<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config\RuleDB\Who;

class RegexCreateRequest
{
    /**
     * @param int $ogroup Object Groups ID.
     * @param string $regex Email address regular expression.
     */
    public function __construct(
        public int $ogroup,
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
