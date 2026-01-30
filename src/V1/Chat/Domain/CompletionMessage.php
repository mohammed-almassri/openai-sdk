<?php
declare(strict_types=1);
namespace Massrimcp\OpenAiClient\V1\Chat\Domain;

final readonly class CompletionMessage
{
    public function __construct(
        private string $role,
        private string $content,
    ){}

    /**
     * @return array{role: string, content:string}
     */
    public function toArray():array{
        return [
            'role' => $this->role,
            'content' => $this->content,
        ];
    }

    /**
     * @param array $message
     * @return self
     */
    public static function from(array $message):self{
        return new self(
            role: $message["role"],
            content: $message["content"],
        );
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getContent(): string
    {
        return $this->content;
    }

}