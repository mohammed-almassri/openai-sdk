<?php

declare(strict_types=1);

namespace Massrimcp\OpenAiSdk\V1\Chat\Dtos;

use http\Exception\InvalidArgumentException;
use Massrimcp\OpenAiSdk\V1\Chat\Domain\CompletionMessage;

final readonly class ChatCompletionRequest
{
    /**
     * @param array<CompletionMessage> $messages
     */
    public function __construct(
        private string $model,
        private array $messages,
        private int $maxTokens,
        private string $responseFormat = "text",
        private ?array $jsonSchema = null,
        private float $temperature = 1.0,
    ) {
        if (empty($this->model)) {
            throw new InvalidArgumentException('model cannot be empty');
        }
        if ($this->temperature < 0 || $this->temperature > 2) {
            throw new InvalidArgumentException('temperature must be between 0 and 2');
        }
        if (!in_array($this->responseFormat, ['text', 'json_schema'])) {
            throw new InvalidArgumentException('response format is not valid. possible values "text", "json_schema"');
        }

        if($this->responseFormat == "json_schema" && $this->jsonSchema === null) {
            throw new InvalidArgumentException('you must provide a jsonSchema if the responseFormat is "json_schema"');
        }

    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getMaxTokens(): int
    {
        return $this->maxTokens;
    }

    public function getResponseFormat(): string
    {
        return $this->responseFormat;
    }

    public function getJsonSchema(): ?array
    {
        return $this->jsonSchema;
    }



    /**
     * @return array<int, array{role: string, content:string}>
     */
    public function messagesToArray(): array
    {
        $ret = [];
        foreach ($this->messages as $message) {
            $ret[] = $message->toArray();
        }

        return $ret;
    }
}
