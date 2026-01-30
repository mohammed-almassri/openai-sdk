<?php
declare (strict_types = 1);

namespace Massrimcp\tests;

use Massrimcp\OpenAiSdk\OpenAiClient;
use PHPUnit\Framework\TestCase;

final class OpenAiSdkTest extends TestCase
{
    public function testThrowsExceptionOnEmptyApiKey(): void
    {
        $client = new OpenAiClient("test-key");

    }
}
