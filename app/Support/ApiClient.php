<?php

namespace App\Support;

use App\Enums\HttpMethod;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class ApiClient
{

    public function send(ApiRequest $request): Response
    {
        return $this->getBaseRequest()
            ->withHeaders($request->getHeaders())
            ->{$request->getMethod()->value}(
                $request->getUri(),
                $request->getMethod() === HttpMethod::GET
                    ? $request->getQuery()
                    : $request->getBody()
            );
    }

    protected function getBaseRequest(): PendingRequest
    {
        $request = Http::acceptJson()
            ->contentType('application/json')
            ->throw()
            ->baseUrl($this->baseUrl());

        return $this->authorize($request);
    }

    protected function authorize(PendingRequest $request): PendingRequest
    {
        return $request;
    }

    abstract protected function baseUrl(): string;
}
