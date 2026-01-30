<?php

namespace Massrimcp\OpenAiClient\V1\Chat\Domain;

final readonly class CompletionChoice
{
    public function __construct(
        private CompletionMessage $message,
    ){}

    public static function from(array $choice):self{
        return new self(
            message: completionMessage::from($choice['message']),
        );
    }

    public function getMessage(): CompletionMessage
    {
        return $this->message;
    }
}