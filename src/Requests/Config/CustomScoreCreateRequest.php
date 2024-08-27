<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Config;

class CustomScoreCreateRequest
{
    /**
     * @param string $name The name of the rule.
     * @param float $score The score the rule should be valued at.
     * @param string|null $comment The Comment.
     * @param string|null $digest Prevent changes if current configuration file has a different digest.
     */
    public function __construct(
        public string $name,
        public float $score,
        public ?string $comment = null,
        public ?string $digest = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'score' => $this->score,
            'comment' => $this->comment,
            'digest' => $this->digest,
        ], fn($value) => $value !== null);
    }
}
