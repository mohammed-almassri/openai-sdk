<?php
declare (strict_types = 1);

namespace Massrimcp\OpenAiSdk\V1\Chat;

use GuzzleHttp\Client as HttpClient;
use Massrimcp\OpenAiSdk\V1\Chat\Domain\CompletionChoice;
use Massrimcp\OpenAiSdk\V1\Chat\Dtos\ChatCompletionRequest;
use Massrimcp\OpenAiSdk\V1\Chat\Dtos\ChatCompletionResponse;

final class ChatClient
{
    private function __construct(
        private readonly HttpClient $httpClient,
    ) {
    }

    public static function fromRoot(HttpClient $httpClient): self
    {
        return new self($httpClient);
    }

    /**
     * @param ChatCompletionRequest $request
     * @return ChatCompletionResponse
     */
    public function createCompletion(ChatCompletionRequest $request): ChatCompletionResponse
    {
        $response = $this->httpClient->post("/v1/chat/completions", [
            \GuzzleHttp\RequestOptions::JSON => [
                'messages'    => $request->messagesToArray(),
                'max_tokens'  => $request->getMaxTokens(),
                'model'       => $request->getModel(),
                'temperature' => $request->getTemperature(),
            ],
        ]);

        $response       = $response->getBody()->getContents();
        $parsedResponse = json_decode($response, true);

        $choices = array_map(fn($choice) => CompletionChoice::from($choice), $parsedResponse["choices"]);

        return new ChatCompletionResponse(
            id: $parsedResponse["id"],
            choices: $choices,
        );
    }

}
