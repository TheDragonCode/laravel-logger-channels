<?php

namespace Helldar\LaravelLoggerChannels\Loggers\ProcessesRotation;

use DateTime;
use DateTimeInterface;
use Helldar\LaravelLoggerChannels\Traits\Configurable;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as Monolog;

class Logger
{
    use Configurable;

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

    protected function getConfigPath(array $config): ?string
    {
        return $config['path'] ?? null;
    }

    protected function getConfigDays(array $config): int
    {
        return $config['days'] ?? 7;
    }

    protected function getConfigBubble(array $config): bool
    {
        return (bool) ($config['bubble'] ?? true);
    }

    protected function getConfigPermission(array $config): ?int
    {
        return $config['permission'] ?? null;
    }

    protected function getConfigLocking(array $config): bool
    {
        return (bool) ($config['locking'] ?? false);
    }
}
