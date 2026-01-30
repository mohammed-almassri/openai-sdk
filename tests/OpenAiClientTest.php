<?php

declare(strict_types=1);

namespace Massrimcp\OpenAiSdk\Tests;

use Massrimcp\OpenAiSdk\OpenAiClient;
use Massrimcp\OpenAiSdk\V1\Chat\Domain\CompletionMessage;
use Massrimcp\OpenAiSdk\V1\Chat\Dtos\ChatCompletionRequest;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class OpenAiClientTest extends TestCase
{
    public function testThrowsExceptionOnEmptyApiKey(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $client = new OpenAiClient('');
    }

    public function testSendsChatMessage(): void
    {
        $client = new OpenAiClient('api-key');
        $client->chat()->createCompletion(new ChatCompletionRequest(
            model: 'gpt-4o-mini',
            maxTokens: 500,
            messages: [
                new CompletionMessage(content: 'test', role: 'user'),
            ]
        ));
    }
}
