<?php

namespace Helldar\LaravelLoggerChannels\Loggers\ProcessesRotation;

use DateTime;
use DateTimeInterface;
use Helldar\LaravelLoggerChannels\Traits\Leveleable;

class RotatingFileHandler extends \Monolog\Handler\RotatingFileHandler
{
    use Leveleable;

    public function __construct(array $config)
    {
        parent::__construct(
            $this->getConfigPath($config),
            $this->getConfigDays($config),
            $this->level($config),
            $this->getBubble($config),
            $this->getConfigPermission($config),
            $this->getConfigLocking($config)
        );
    }

    protected function getTimedFilename(): string
    {
        $info = pathinfo($this->filename);

        $dir      = $info['dirname'];
        $filename = $info['filename'];
        $ext      = $info['extension'] ?? null;

        $formatted = str_replace(
            ['{filename}', '{date}'],
            [$filename, $this->getFilenameSuffix()],
            $dir . '/' . $this->filenameFormat
        );

        $micro = $this->getLaravelMicroseconds();

        return $ext ? "{$formatted}_{$micro}.{$ext}" : "{$formatted}_{$micro}";
    }

    protected function getFilenameSuffix(): string
    {
        return $this->date()
            ->setTimestamp($this->getLaravelStart())
            ->format('Y-m-d_H-i-s');
    }

    protected function getLaravelMicroseconds(): int
    {
        return array_reverse(explode('.', $this->getLaravelStart(), 2))[0];
    }

    protected function date(): DateTimeInterface
    {
        return new DateTime();
    }

    protected function getLaravelStart()
    {
        return LARAVEL_START;
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
