<?php

declare(strict_types=1);

namespace Massrimcp\OpenAiSdk;

use GuzzleHttp\Client as HttpClient;
use Massrimcp\OpenAiSdk\V1\Chat\ChatClient;

final class OpenAiClient
{
    private HttpClient $httpClient;

    public function __construct(
        private readonly string $apiKey,
    ) {
        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException('api key is required');
        }
        $this->httpClient = new HttpClient(
            [
                'base_uri' => 'https://api.openai.com',
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer {$this->apiKey}",
                ],
                'timeout' => 60,
            ]
        );
    }

    public function chat(): ChatClient
    {
        return ChatClient::fromRoot($this->httpClient);
    }

    public function ping(): bool
    {
        return true;
    }
}
