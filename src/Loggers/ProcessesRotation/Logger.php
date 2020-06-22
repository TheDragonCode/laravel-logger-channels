<?php

namespace Helldar\LaravelLoggerChannels\Loggers\ProcessesRotation;

use DateTime;
use DateTimeInterface;
use Helldar\LaravelLoggerChannels\Traits\LogConfiguration;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as Monolog;

class Logger
{
    use LogConfiguration;

    public function __invoke(array $config)
    {
        $handler = $this->getRotatingFileHandler($config);

        $this->setFileFormat($handler);

        return new Monolog($this->channelName($config), [$handler]);
    }

    protected function getRotatingFileHandler(array $config): RotatingFileHandler
    {
        return new RotatingFileHandler(
            $this->getConfigPath($config),
            $this->getConfigDays($config),
            $this->level($config),
            $this->getConfigBubble($config),
            $this->getConfigPermission($config),
            $this->getConfigLocking($config)
        );
    }

    protected function setFileFormat(RotatingFileHandler $handler): void
    {
        $handler->setFilenameFormat($this->getFilenameFormat(), $this->getDateFormat());
    }

    protected function getDateFormat(): string
    {
        return RotatingFileHandler::FILE_PER_DAY;
    }

    protected function getFilenameFormat(): string
    {
        return '{filename}-{date}-' . $this->getFilenameSuffix();
    }

    protected function getFilenameSuffix(): string
    {
        return $this->date()->setTimestamp(LARAVEL_START)->format('H-i-s');
    }

    protected function date(): DateTimeInterface
    {
        return new DateTime();
    }

    protected function getFallbackChannelName()
    {
        return 'production';
    }
}
