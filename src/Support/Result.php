<?php

namespace Cyberfusion\ProxmoxMGW\Support;

class Result
{
    public function __construct(
        private readonly bool $success = false,
        private readonly string $message = '',
        private array $data = []
    ) {
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function failed(): bool
    {
        return ! $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(string $key = null): mixed
    {
        if (! is_null($key)) {
            return array_key_exists($key, $this->data)
                ? $this->data[$key]
                : null;
        }

        return $this->data;
    }
}
