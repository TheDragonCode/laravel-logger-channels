## Laravel Logger Channels

Set of custom loggers for Monolog in Laravel.

<p align="center">
    <a href="https://packagist.org/packages/andrey-helldar/laravel-logger-channels"><img src="https://img.shields.io/packagist/dt/andrey-helldar/laravel-logger-channels.svg?style=flat-square" alt="Total Downloads" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/laravel-logger-channels"><img src="https://poser.pugx.org/andrey-helldar/laravel-logger-channels/v/stable?format=flat-square" alt="Latest Stable Version" /></a>
    <a href="https://packagist.org/packages/andrey-helldar/laravel-logger-channels"><img src="https://poser.pugx.org/andrey-helldar/laravel-logger-channels/v/unstable?format=flat-square" alt="Latest Unstable Version" /></a>
</p>
<p align="center">
    <a href="https://styleci.io/repos/274123087"><img src="https://styleci.io/repos/274123087/shield" alt="StyleCI" /></a>
    <a href="LICENSE"><img src="https://poser.pugx.org/andrey-helldar/laravel-logger-channels/license?format=flat-square" alt="License" /></a>
</p>


## Content
* [Installation](#installation)
* [Using](#using)
    * [Processes Rotation](#processes-rotation)
* [Credits](#credits)


## Installation

To get the latest version of `Laravel Logger Channels`, simply require the project using [Composer](https://getcomposer.org/):

```bash
$ composer require andrey-helldar/laravel-logger-channels
```

This command will automatically install the latest version of the package for your environment.

Instead, you may of course manually update your `require` block and run `composer update` if you so choose:

```json
{
    "require": {
        "andrey-helldar/laravel-logger-channels": "^1.0"
    }
}
```


## Using

There are two methods for using custom loggers - calling a class with a settings preset or manually setting a logger.

### Processes Rotation

Add a new channel in file `config/logging.php` or modify an existing one using one of the following methods:

1.
```php
use Helldar\LaravelLoggerChannels\Loggers\ProcessesRotation\DifferentLogsChannel;

return [
    'channels' => [
        'your_channel' => DifferentLogsChannel::get(
            storage_path('logs/your-filename.log')
        )
    ]
];
```

2.
```php
use Helldar\LaravelLoggerChannels\Loggers\ProcessesRotation\Logger;

return [
    'channels' => [
        'your_channel' => [
            'driver' => 'custom',
            'via'    => Logger::class,
            'path'   => storage_path('logs/your-filename.log'),
            'days'   => 14,
        ]
    ]
];
```

In each case, one log file will be created for one session. The session label is taken from the global variable `LARAVEL_START`.


## Credits

- [Andrey Helldar][link_author]
- [![All contributors][badge_contributors]][link_contributors]


[badge_contributors]:   https://img.shields.io/github/contributors/andrey-helldar/laravel-logger-channels?style=flat-square

[link_author]:          https://github.com/andrey-helldar
[link_contributors]:    https://github.com/andrey-helldar/laravel-logger-channels/graphs/contributors
