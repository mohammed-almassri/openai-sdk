<?php
declare(strict_types=1);
namespace Massrimcp\OpenAiClient\V1\Chat\Dtos;

use Massrimcp\OpenAiClient\V1\Chat\Domain\CompletionChoice;

final readonly class ChatCompletionResponse
{
    /**
     * @param string $id
     * @param array<CompletionChoice> $choices
     */
    public function __construct(
        private readonly string $id,
        private readonly array  $choices,
    ){}

    public function getId(): string
    {
        return $this->id;
    }

    public function getChoices(): array
    {
        return $this->choices;
    }
}