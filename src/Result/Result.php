<?php

namespace YWatchman\ProxmoxMGW\Result;

class Result
{
    protected bool $success = false;

    protected string $message = '';

    protected array $data = [];

    public function __construct(bool $success = false, string $message = '', array $data = [])
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

    public function succeeded(): bool
    {
        return $this->success;
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
