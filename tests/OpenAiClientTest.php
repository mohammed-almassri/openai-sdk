<?php

declare(strict_types=1);

namespace Massrimcp\OpenAiSdk\Tests;

use Massrimcp\OpenAiSdk\OpenAiClient;
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
}
