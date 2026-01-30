<?php
declare(strict_types=1);

namespace Massrimcp\tests;

use Massrimcp\OpenAiClient\OpenAiClient;
use PHPUnit\Framework\TestCase;

final class OpenAiClientTest extends TestCase
{
    public function testThrowsExceptionOnEmptyApiKey():void{
        $client = new OpenAiClient("","");

    }
}