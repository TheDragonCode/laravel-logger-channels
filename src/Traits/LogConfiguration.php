<?php

namespace Helldar\LaravelLoggerChannels\Traits;

use InvalidArgumentException;
use Monolog\Logger as Monolog;

trait LogConfiguration
{
    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [
        'debug'     => Monolog::DEBUG,
        'info'      => Monolog::INFO,
        'notice'    => Monolog::NOTICE,
        'warning'   => Monolog::WARNING,
        'error'     => Monolog::ERROR,
        'critical'  => Monolog::CRITICAL,
        'alert'     => Monolog::ALERT,
        'emergency' => Monolog::EMERGENCY,
    ];

    /**
     * Get fallback log channel name.
     *
     * @return string
     */
    abstract protected function getFallbackChannelName();

    /**
     * Parse the string level into a Monolog constant.
     *
     * @param  array  $config
     *
     * @throws \InvalidArgumentException
     *
     * @return int
     */
    protected function level(array $config)
    {
        $level = $config['level'] ?? 'debug';

        if (isset($this->levels[$level])) {
            return $this->levels[$level];
        }

        throw new InvalidArgumentException('Invalid log level.');
    }

    /**
     * Extract the log channel from the given configuration.
     *
     * @param  array  $config
     *
     * @return string
     */
    protected function channelName(array $config)
    {
        return $config['name'] ?? $this->getFallbackChannelName();
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
