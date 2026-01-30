<?php

declare(strict_types=1);

namespace Massrimcp\OpenAiSdk;

use GuzzleHttp\Client;
use Massrimcp\OpenAiSdk\V1\Chat\ChatClient;
use Psr\Http\Client\ClientInterface;

final class OpenAiClient
{
    private ClientInterface $httpClient;

    public function __construct(
        private readonly string $apiKey,
        private readonly ?ClientInterface $client = null,
    ) {

        if (empty($this->apiKey)) {
            throw new \InvalidArgumentException('api key is required');
        }

        if($client === null) {
            $this->httpClient = new Client(
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
