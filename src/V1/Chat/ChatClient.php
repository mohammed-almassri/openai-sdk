<?php

declare(strict_types=1);

namespace Massrimcp\OpenAiSdk\V1\Chat;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;
use Massrimcp\OpenAiSdk\V1\Chat\Domain\CompletionChoice;
use Massrimcp\OpenAiSdk\V1\Chat\Dtos\ChatCompletionRequest;
use Massrimcp\OpenAiSdk\V1\Chat\Dtos\ChatCompletionResponse;

final class ChatClient
{
    private static $instance;

    private function __construct(
        private readonly HttpClient $httpClient,
    ) {}

    public static function getInstance(HttpClient $httpClient): self
    {
        if (null === self::$instance) {
            self::$instance = new self($httpClient);
        }

        return self::$instance;
    }

    public function createCompletion(ChatCompletionRequest $request): ChatCompletionResponse
    {
        $body = [
            'messages' => $request->messagesToArray(),
            'max_tokens' => $request->getMaxTokens(),
            'model' => $request->getModel(),
            'temperature' => $request->getTemperature(),
        ];

        if ('json_schema' === $request->getResponseFormat()) {
            $body['response_format'] = [
                'type' => 'json_schema',
                'json_schema' => $request->getJsonSchema(),
            ];
        }

        $response = $this->httpClient->post('/v1/chat/completions', [
            RequestOptions::JSON => $body,
        ]);

        $response = $response->getBody()->getContents();
        $parsedResponse = json_decode($response, true);

        $choices = array_map(fn ($choice) => CompletionChoice::from($choice), $parsedResponse['choices']);

        return new ChatCompletionResponse(
            id: $parsedResponse['id'],
            choices: $choices,
        );
    }
}
