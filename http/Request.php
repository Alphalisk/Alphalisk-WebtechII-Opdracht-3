<?php

namespace http;

class Request
{
    public function __construct(
        private readonly array $server,
        private readonly array $post
    ){}

    public function getRequestMethod(): string
    {
        return strtoupper($this->server['REQUEST_METHOD']);
    }

    public function getPostValue(string $key):?string {
        if (array_key_exists($key, $this->post)) return $this->post[$key];
        return null;
    }

    public function getPostValuesAll(array $keys):?array {
        $tmp = [];
        foreach ($keys as $k) {
            $tmp[] = $this->post[$k];
        }
        return $tmp;
    }

    public function getPreferredContentType():string {
        return strtolower(explode(',', $this->server['HTTP_ACCEPT'])[0]);
    }

}