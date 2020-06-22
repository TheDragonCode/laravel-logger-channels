<?php

namespace Helldar\LaravelLoggerChannels\Loggers\ProcessesRotation;

use Helldar\LaravelLoggerChannels\Traits\Configurable;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as Monolog;

class Logger
{
    use Configurable;

    public function __invoke(array $config)
    {
        return new Monolog($this->channelName($config), [
            $this->getRotatingFileHandler($config),
        ]);
    }

    protected function getRotatingFileHandler(array $config): StreamHandler
    {
        return new RotatingFileHandler($config);
    }
}
