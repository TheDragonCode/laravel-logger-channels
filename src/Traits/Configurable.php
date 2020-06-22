<?php

namespace Helldar\LaravelLoggerChannels\Traits;

trait Configurable
{
    /**
     * Get fallback log channel name.
     *
     * @return string
     */
    protected function getFallbackChannelName()
    {
        return 'production';
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
}
