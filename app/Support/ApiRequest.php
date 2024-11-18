<?php

namespace App\Support;

use App\Enums\HttpMethod;

class ApiRequest
{
    protected array $headers = [];

    protected array $query = [];

    protected array $body = [];

    public function __construct(protected HttpMethod $method = HttpMethod::GET, protected string $uri = '')
    {
    }

    public function setHeaders(array|string $key, string $value = null): static
    {
        if (is_array($key)) {
            $this->headers = $key;
        } else {
            $this->headers[$key] = $value;
        }

        return $this;
    }

    public function clearHeaders(string $key = null): static
    {
        if ($key) {
            unset($this->headers[$key]);
        } else {
            $this->headers = [];
        }

        return $this;
    }

    public function setQuery(array|string $key, string $value = null): static
    {
        if (is_array($key)) {
            $this->query = $key;
        } else {
            $this->query[$key] = $value;
        }

        return $this;
    }

    public function clearQuery(string $key = null): static
    {
        if ($key) {
            unset($this->query[$key]);
        } else {
            $this->query = [];
        }

        return $this;
    }

    public function setBody(array|string $key, string $value = null): static
    {
        if (is_array($key)) {
            $this->body = $key;
        } else {
            $this->body[$key] = $value;
        }

        return $this;
    }

    public function clearBody(string $key = null): static
    {
        if ($key) {
            unset($this->body[$key]);
        } else {
            $this->body = [];
        }

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getUri(): string
    {
        if (empty($this->query) || $this->method === HttpMethod::GET) {
            return $this->uri;
        }

        return $this->uri . '?' . http_build_query($this->query);
    }

    public function getMethod(): HttpMethod
    {
        return $this->method;
    }

    public static function get(string $uri = ''): static
    {
        return new static(HttpMethod::GET, $uri);
    }

    public static function post(string $uri = ''): static
    {
        return new static(HttpMethod::POST, $uri);
    }

    public static function put(string $uri = ''): static
    {
        return new static(HttpMethod::PUT, $uri);
    }

    public static function delete(string $uri = ''): static
    {
        return new static(HttpMethod::DELETE, $uri);
    }
}
