<?php


namespace YWatchman\ProxmoxMGW\Result;


class Result
{

    /** @var bool  */
    protected $success = false;

    /** @var string  */
    protected $message = '';

    /** @var array  */
    protected $data = [];

    /**
     * Result constructor.
     *
     * @param bool $success
     * @param string $message
     * @param array $data
     */
    public function __construct(bool $success = false, string $message = '', array $data = [])
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function succeeded(): bool
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function getData(string $key = null)
    {
        if (! is_null($key)) {
            return array_key_exists($key, $this->data)
                ? $this->data[$key]
                : null;
        }

        return $this->data;
    }


}
