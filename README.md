# PHP SDK for OpenAI API

A modern PHP SDK for interacting with the OpenAI API, including support for Chat, Completions, and more. Built for PHP 8+ with a focus on developer experience, type safety, and extensibility.

## Features

- Simple and intuitive API for OpenAI endpoints
- Support for Chat, Completions, and other OpenAI features
- DTOs for request/response payloads
- Extensible and testable client architecture
- PSR-7/PSR-18 compatible HTTP client support

## Installation

Install via Composer:

```bash
composer require your-vendor/php-sdk
```

## Usage

```php
use YourVendor\OpenAiSdk\OpenAiSdk;

$client = new OpenAiClient('your-api-key');

$response = $client->chat()->create([
    'model' => 'gpt-4',
    'messages' => [
        ['role' => 'user', 'content' => 'Hello!'],
    ],
]);

print_r($response);
```

### Chat API Example

```php
$chatClient = $client->chat();
$result = $chatClient->create([
    'model' => 'gpt-4',
    'messages' => [
        ['role' => 'user', 'content' => 'Tell me a joke.'],
    ],
]);
echo $result['choices'][0]['message']['content'];
```

## Testing

Run tests with PHPUnit:

```bash
vendor/bin/phpunit
```

## Requirements

- PHP 8.0 or higher
- Composer
- PSR-7/PSR-18 compatible HTTP client (e.g., Guzzle)

## Contributing

Contributions are welcome! Please open issues or submit pull requests.

## License

This project is licensed under the MIT License.
